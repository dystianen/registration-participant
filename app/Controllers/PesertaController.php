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
        return view('peserta/index');
    }

    public function create()
    {
        // Step 1: Insert data into peserta table
        $dataPeserta = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
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
            ],
            [
                'id_peserta' => $id_peserta,
                'jenjang' => $this->request->getVar('jenjang2'),
                'nama_sekolah' => $this->request->getVar('nama_sekolah2'),
                'lokasi' => $this->request->getVar('lokasi2'),
                'tahun_lulus' => $this->request->getVar('tahun_lulus2'),
            ],
            [
                'id_peserta' => $id_peserta,
                'jenjang' => $this->request->getVar('jenjang3'),
                'nama_sekolah' => $this->request->getVar('nama_sekolah3'),
                'lokasi' => $this->request->getVar('lokasi3'),
                'tahun_lulus' => $this->request->getVar('tahun_lulus3'),
            ],
        ];

        // Insert the batch of data into jenjang table
        $this->jenjangModel->insertBatch($dataJenjang);

        // Step 3: Set flash message and redirect
        session()->setFlashdata('success', 'Register Successfully.');
        return redirect()->to(base_url("/peserta"));
    }
}
