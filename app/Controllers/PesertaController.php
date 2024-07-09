<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenjangModel;
use App\Models\PesertaModel;
use CodeIgniter\API\ResponseTrait;

class PesertaController extends BaseController
{
    use ResponseTrait;

    protected $pesertaModel, $jenjangModel;
    public function __construct()
    {
        $this->pesertaModel = new PesertaModel();
        $this->jenjangModel = new JenjangModel();
    }

    public function index(): string
    {
        return view('pages/daftar-riwayat/index');
    }

    public function listPesertaView()
    {
        $peserta = $this->pesertaModel
            ->where('peserta.deleted_at', null, true)
            ->findAll();

        $data = [
            "data" => $peserta,
        ];
        return view('/pages/peserta/index.php', $data);
    }

    public function editView()
    {

        // Get id_peserta from query parameters
        $id_peserta = $this->request->getVar('id_peserta');

        // Fetch the specific peserta by id_peserta
        $peserta = $this->pesertaModel
            ->where('id_peserta', $id_peserta)
            ->where('deleted_at', null)
            ->first();  // Use first() to retrieve a single row

        $jenjang = $this->pesertaModel
            ->select('jenjang.*')
            ->join('jenjang', 'jenjang.id_peserta = peserta.id_peserta')
            ->where('peserta.id_peserta', $id_peserta)
            ->where('jenjang.deleted_at', null)
            ->findAll();

        $data = [
            "peserta" => $peserta,
            "jenjang" => $jenjang,
        ];

        return view('pages/peserta/edit.php', $data);
    }

    public function create()
    {
        // Step 1: Insert data into peserta table
        $dataPeserta = [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'nomor_ktp' => $this->request->getVar('nomor_ktp'),
            'nama_peserta' => $this->request->getVar('nama_peserta'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
            'status' => "PENDING",
            'deleted_at' => null,
        ];

        // Perform the insert and capture the inserted ID
        $this->pesertaModel->insert($dataPeserta);
        $id_peserta = $this->pesertaModel->insertID(); // Get the ID of the inserted row

        // Step 2: Insert data into jenjang table using insertBatch
        $dataJenjang = [
            [
                'id_peserta' => $id_peserta,
                'jenjang' => $this->request->getVar('jenjang1'),
                'nama_sekolah' => $this->request->getVar('nama_sekolah1'),
                'lokasi' => $this->request->getVar('lokasi1'),
                'tahun_lulus' => $this->request->getVar('tahun_lulus1'),
                'deleted_at' => null,
            ],
            [
                'id_peserta' => $id_peserta,
                'jenjang' => $this->request->getVar('jenjang2'),
                'nama_sekolah' => $this->request->getVar('nama_sekolah2'),
                'lokasi' => $this->request->getVar('lokasi2'),
                'tahun_lulus' => $this->request->getVar('tahun_lulus2'),
                'deleted_at' => null,
            ],
            [
                'id_peserta' => $id_peserta,
                'jenjang' => $this->request->getVar('jenjang3'),
                'nama_sekolah' => $this->request->getVar('nama_sekolah3'),
                'lokasi' => $this->request->getVar('lokasi3'),
                'tahun_lulus' => $this->request->getVar('tahun_lulus3'),
                'deleted_at' => null,
            ],
        ];

        // Insert the batch of data into jenjang table
        $this->jenjangModel->insertBatch($dataJenjang);

        // Step 3: Set flash message and redirect
        session()->setFlashdata('success', 'Register Successfully.');
        return redirect()->to(base_url("/login"));
    }

    public function edit($id_peserta)
    {
        // Check if id_peserta is present
        if (!$id_peserta) {
            return redirect()->to('/peserta')->with('error', 'ID Peserta is required');
        }

        // Step 1: Update data in peserta table
        $dataPeserta = [
            'email' => $this->request->getVar('email'),
            'nomor_ktp' => $this->request->getVar('nomor_ktp'),
            'nama_peserta' => $this->request->getVar('nama_peserta'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
            'status' => $this->request->getVar('status'),
        ];

        if ($this->request->getVar('password')) {
            $dataPeserta['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        $this->pesertaModel->update($id_peserta, $dataPeserta);

        // Step 2: Update data in jenjang table
        $index = 1;
        while ($this->request->getVar("jenjang$index")) {
            $dataJenjang = [
                'jenjang' => $this->request->getVar("jenjang$index"),
                'nama_sekolah' => $this->request->getVar("nama_sekolah$index"),
                'lokasi' => $this->request->getVar("lokasi$index"),
                'tahun_lulus' => $this->request->getVar("tahun_lulus$index"),
            ];

            $jenjangId = $this->request->getVar("jenjang_id$index");

            if ($jenjangId) {
                $this->jenjangModel->update($jenjangId, $dataJenjang);
            } else {
                $dataJenjang['id_peserta'] = $id_peserta;
                $this->jenjangModel->insert($dataJenjang);
            }

            $index++;
        }

        session()->setFlashdata('success', 'Updated Successfully.');
        return redirect()->to(base_url("/peserta"));
    }

    public function approve($id_peserta)
    {
        // Update status to APPROVED
        $this->pesertaModel->update($id_peserta, ['status' => 'APPROVED']);

        // Set flash message and redirect
        session()->setFlashdata('success', 'Peserta approved successfully.');
        return redirect()->to(base_url('/peserta'));
    }

    public function delete($id_peserta)
    {
        // Set deleted_at to current timestamp
        $this->pesertaModel->update($id_peserta, ['deleted_at' => date('Y-m-d H:i:s')]);

        // Set flash message and redirect
        session()->setFlashdata('success', 'Peserta deleted successfully.');
        return redirect()->to(base_url('/peserta'));
    }
}
