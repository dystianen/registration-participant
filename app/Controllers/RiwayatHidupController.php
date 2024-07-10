<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendidikanModel;
use App\Models\RiwayatHidupModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class RiwayatHidupController extends BaseController
{
    use ResponseTrait;

    protected $userModel, $riwayatHidupModel, $pendidikanModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->riwayatHidupModel = new RiwayatHidupModel();
        $this->pendidikanModel = new PendidikanModel();
    }

    public function index(): string
    {
        $id_user = $this->request->getVar('id_user');
        $user = $this->userModel
            ->where('id_user', $id_user)
            ->first();

        $data = [
            'user' => $user
        ];

        return view('pages/daftar-riwayat/index', $data);
    }

    public function listRiwayatHidupView()
    {
        $riwayat_hidup = [];
        if (session()->get('role') == "PESERTA") {
            $riwayat_hidup = $this->riwayatHidupModel
                ->select('riwayat_hidup.*, users.*')
                ->join('users', 'riwayat_hidup.id_user = users.id_user')
                ->where('riwayat_hidup.id_user', session()->get('id_user'))
                ->where('riwayat_hidup.deleted_at', null)
                ->findAll();
        } else {
            $riwayat_hidup = $this->riwayatHidupModel
                ->where('deleted_at', null)
                ->findAll();
        }

        $data = [
            "data" => $riwayat_hidup,
        ];
        return view('/pages/peserta/index.php', $data);
    }

    public function editView()
    {
        $id_riwayat_hidup = $this->request->getVar('id_riwayat_hidup');

        $peserta = $this->riwayatHidupModel
            ->select('riwayat_hidup.*, users.*')
            ->join('users', 'riwayat_hidup.id_user = users.id_user')
            ->where('riwayat_hidup.id_riwayat_hidup', $id_riwayat_hidup)
            ->where('riwayat_hidup.deleted_at', null)
            ->first();

        $pendidikan = $this->pendidikanModel
            ->select('pendidikan.*, riwayat_hidup.*')
            ->join('riwayat_hidup', 'pendidikan.id_riwayat_hidup = riwayat_hidup.id_riwayat_hidup')
            ->where('pendidikan.id_riwayat_hidup', $id_riwayat_hidup)
            ->where('riwayat_hidup.deleted_at', null)
            ->findAll();


        $data = [
            "peserta" => $peserta,
            "pendidikan" => $pendidikan,
        ];

        return view('pages/peserta/edit.php', $data);
    }

    public function create()
    {
        // Step 1: Insert data into peserta table
        $id_user = $this->request->getVar('id_user');
        $data_riwayat_hidup = [
            'id_user' => $id_user,
            'nomor_ktp' => $this->request->getVar('nomor_ktp'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
            'status' => "PENDING",
            'deleted_at' => null,
        ];

        // Perform the insert and capture the inserted ID
        $this->riwayatHidupModel->insert($data_riwayat_hidup);
        $id_riwayat_hidup = $this->riwayatHidupModel->insertID(); // Get the ID of the inserted row

        // Step 2: Insert data into jenjang table using insertBatch
        $dataPendidikan = [
            [
                'id_riwayat_hidup' => $id_riwayat_hidup,
                'jenjang' => $this->request->getVar('jenjang1'),
                'nama_sekolah' => $this->request->getVar('nama_sekolah1'),
                'lokasi' => $this->request->getVar('lokasi1'),
                'tahun_lulus' => $this->request->getVar('tahun_lulus1'),
                'deleted_at' => null,
            ],
            [
                'id_riwayat_hidup' => $id_riwayat_hidup,
                'jenjang' => $this->request->getVar('jenjang2'),
                'nama_sekolah' => $this->request->getVar('nama_sekolah2'),
                'lokasi' => $this->request->getVar('lokasi2'),
                'tahun_lulus' => $this->request->getVar('tahun_lulus2'),
                'deleted_at' => null,
            ],
            [
                'id_riwayat_hidup' => $id_riwayat_hidup,
                'jenjang' => $this->request->getVar('jenjang3'),
                'nama_sekolah' => $this->request->getVar('nama_sekolah3'),
                'lokasi' => $this->request->getVar('lokasi3'),
                'tahun_lulus' => $this->request->getVar('tahun_lulus3'),
                'deleted_at' => null,
            ],
        ];

        // Insert the batch of data into jenjang table
        $this->pendidikanModel->insertBatch($dataPendidikan);

        // Step 3: Set flash message and redirect
        session()->setFlashdata('success', 'Add Riwayat Hidup Successfully.');
        return redirect()->to(base_url("/waiting?id_user" . $id_user));
    }

    public function edit($id_riwayat_hidup)
    {
        // Check if id_peserta is present
        if (!$id_riwayat_hidup) {
            return redirect()->to('/peserta')->with('error', 'ID Peserta is required');
        }


        // Step 1: Update data in peserta table
        $data_peserta = [
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'nomor_ktp' => $this->request->getVar('nomor_ktp'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
        ];

        $this->riwayatHidupModel->update($id_riwayat_hidup, $data_peserta);

        // Step 2: Update data in jenjang table
        $index = 1;
        while ($this->request->getVar("jenjang$index")) {
            $data_pendidikan = [
                'jenjang' => $this->request->getVar("jenjang$index"),
                'nama_sekolah' => $this->request->getVar("nama_sekolah$index"),
                'lokasi' => $this->request->getVar("lokasi$index"),
                'tahun_lulus' => $this->request->getVar("tahun_lulus$index"),
            ];

            $pendidikan_id = $this->request->getVar("pendidikan_id$index");

            if ($pendidikan_id) {
                $this->pendidikanModel->update($pendidikan_id, $data_pendidikan);
            } else {
                $data_pendidikan['id_riwayat_hidup'] = $id_riwayat_hidup;
                $this->pendidikanModel->insert($data_pendidikan);
            }

            $index++;
        }

        session()->setFlashdata('success', 'Updated Successfully.');
        return redirect()->to(base_url("/peserta"));
    }

    public function approve($id_peserta)
    {
        // Update status to APPROVED
        $this->userModel->update($id_peserta, ['status' => 'APPROVED']);

        // Set flash message and redirect
        session()->setFlashdata('success', 'Peserta approved successfully.');
        return redirect()->to(base_url('/peserta'));
    }

    public function delete($id_peserta)
    {
        // Set deleted_at to current timestamp
        $this->userModel->update($id_peserta, ['deleted_at' => date('Y-m-d H:i:s')]);

        // Set flash message and redirect
        session()->setFlashdata('success', 'Peserta deleted successfully.');
        return redirect()->to(base_url('/peserta'));
    }
}
