<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<h2>Edit Peserta</h2>

<?php if (session()->getFlashData('failed')) : ?>
  <div class="alert alert-danger" role="alert">
    <?php echo session("failed") ?>
  </div>
<?php endif; ?>

<?php if (session()->getFlashData('success')) : ?>
  <div class="alert success alert-success" role="alert">
    <?php echo session("success") ?>
  </div>
<?php endif; ?>

<section>
  <div class="card">
    <div class="card-body">
      <h5>Daftar Riwayat Hidup</h5>
      <form enctype="multipart/form-data" action="<?php echo base_url(); ?>/peserta/edit/<?= $peserta['id_peserta'] ?>" method="post">
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <input disabled id="status" name="status" class="form-control" value="<?= $peserta['status'] ?>">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= $peserta['email'] ?>">
        </div>
        <div class="mb-3">
          <label for="nomor_ktp" class="form-label">Nomor KTP</label>
          <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" value="<?= $peserta['nomor_ktp'] ?>">
        </div>
        <div class="mb-3">
          <label for="nama_peserta" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="<?= $peserta['nama_peserta'] ?>">
        </div>
        <div class="mb-3">
          <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
          <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $peserta['tempat_lahir'] ?>">
        </div>
        <div class="mb-3">
          <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $peserta['tanggal_lahir'] ?>">
        </div>
        <div class="mb-3">
          <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
          <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" value="<?= $peserta['jenis_kelamin'] ?>">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <textarea class="form-control" id="alamat" name="alamat"><?= $peserta['alamat'] ?></textarea>
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
            <?php $startIndex = 1; ?>
            <?php foreach ($jenjang as $d) : ?>
              <tr>
                <th scope="row">
                  <select class="form-select" id="jenjang<?= $startIndex ?>" name="jenjang<?= $startIndex ?>">
                    <option value="SD" <?= $d['jenjang'] == 'SD' ? 'selected' : '' ?>>SD</option>
                    <option value="SMP" <?= $d['jenjang'] == 'SMP' ? 'selected' : '' ?>>SMP</option>
                    <option value="SMA" <?= $d['jenjang'] == 'SMA' ? 'selected' : '' ?>>SMA</option>
                  </select>
                </th>
                <td>
                  <input type="text" class="form-control" id="nama_sekolah<?= $startIndex ?>" name="nama_sekolah<?= $startIndex ?>" value="<?= $d['nama_sekolah'] ?>">
                </td>
                <td>
                  <input type="text" class="form-control" id="lokasi<?= $startIndex ?>" name="lokasi<?= $startIndex ?>" value="<?= $d['lokasi'] ?>">
                </td>
                <td>
                  <input type="number" class="form-control" id="tahun_lulus<?= $startIndex ?>" name="tahun_lulus<?= $startIndex ?>" value="<?= $d['tahun_lulus'] ?>">
                </td>
                <td>
                  <input type="hidden" name="jenjang_id<?= $startIndex ?>" value="<?= $d['id_jenjang'] ?>">
                </td>
              </tr>
              <?php $startIndex++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
        <a href="/peserta" class="btn btn-outline-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</section>
<?= $this->endSection() ?>