<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<section class="d-flex justify-content-center">
    <div class="card" style="width: 50rem;">
        <div class="card-body">
            <h5 class="mb-4">Daftar Riwayat Hidup</h5>
            <form enctype="multipart/form-data" action="<?php echo base_url(); ?>/peserta/create?id_user=<?= $user['id_user'] ?>" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input disabled type="text" class="form-control" id="nama" name="nama" placeholder="XXXXXXXXXXXX" value="<?= $user['name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="nomor_ktp" class="form-label">Nomor KTP</label>
                    <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" placeholder="XXXXXXXXXXXX">
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat lahir ...">
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="LAKI-LAKI">Laki-laki</option>
                        <option value="PEREMPUAN">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat ..."></textarea>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Jenjang</th>
                            <th scope="col">Nama Sekolah</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Tahun Lulus</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <th scope="row">
                                <select class="form-select" id="jenjang1" name="jenjang1">
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                </select>
                            </th>
                            <td>
                                <input type="text" class="form-control" id="nama_sekolah1" name="nama_sekolah1" placeholder="nama sekolah ...">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="lokasi1" name="lokasi1" placeholder="lokasi ...">
                            </td>
                            <td>
                                <input type="number" type="text" class="form-control" id="tahun_lulus1" name="tahun_lulus1" placeholder="tahun lulus ...">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <select class="form-select" id="jenjang2" name="jenjang2">
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                </select>
                            </th>
                            <td>
                                <input type="text" class="form-control" id="nama_sekolah2" name="nama_sekolah2" placeholder="nama sekolah ...">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="lokasi2" name="lokasi2" placeholder="lokasi ...">
                            </td>
                            <td>
                                <input type="number" type="text" class="form-control" id="tahun_lulus2" name="tahun_lulus2" placeholder="tahun lulus ...">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <select class="form-select" id="jenjang3" name="jenjang3">
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                </select>
                            </th>
                            <td>
                                <input type="text" class="form-control" id="nama_sekolah3" name="nama_sekolah3" placeholder="nama sekolah ...">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="lokasi3" name="lokasi3" placeholder="lokasi ...">
                            </td>
                            <td>
                                <input type="number" type="text" class="form-control" id="tahun_lulus3" name="tahun_lulus3" placeholder="tahun lulus ...">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div>
                        Sudah mengisi daftar riwayat hidup? <a href="/login">Login!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>