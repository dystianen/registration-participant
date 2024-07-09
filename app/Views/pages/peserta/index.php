<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<h2 class="mb-4">Peserta</h2>

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

<div class="card">
  <div class="card-body">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Email</th>
          <th scope="col">Nomor KTP</th>
          <th scope="col">Nama Peserta</th>
          <th scope="col">Tempat Lahir</th>
          <th scope="col">Tanggal Lahir</th>
          <th scope="col">Jenis Kelamin</th>
          <th scope="col">Alamat</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php $startIndex = 1; ?>
        <?php foreach ($data as $d) : ?>
          <tr>
            <td scope="row"><?= $startIndex++ ?></td>
            <td scope="row"><?= $d["email"] ?></td>
            <td><?= $d["nomor_ktp"] ?></td>
            <td><?= $d["nama_peserta"] ?></td>
            <td><?= $d["tempat_lahir"] ?></td>
            <td><?= $d["tanggal_lahir"] ?></td>
            <td><?= $d["jenis_kelamin"] ?></td>
            <td><?= $d["alamat"] ?></td>
            <td><?= $d["status"] ?></td>
            <td>
              <div>
                <?php if (session()->get('role') == 'admin' && $d["status"] !== "APPROVED") : ?>
                  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal<?= $d['id_peserta'] ?>">
                    <i class="fas fa-check" title="Approve"></i>
                  </button>
                <?php endif; ?>
                <button class="btn btn-secondary" onclick="window.location.href = '/peserta/edit?id_peserta=<?= $d['id_peserta'] ?>'">
                  <i class="fas fa-edit" title="Edit"></i>
                </button>
                <?php if (session()->get('role') == 'admin') : ?>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $d['id_peserta'] ?>">
                    <i class="fas fa-trash-alt" title="Delete"></i>
                  </button>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- modal approve -->
<?php foreach ($data as $d) : ?>
  <div class="modal fade" id="approveModal<?= $d['id_peserta'] ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body d-flex flex-column justify-content-center text-center">
          <div class="icon-modal">
            <i class="fa-solid fa-circle-exclamation"></i>
          </div>
          <div class="text-body-modal">
            Are you sure want to approve this data?
          </div>
          <div class="modal-footer" style="justify-content: center; gap: 16px">
            <form class="d-inline" method="post" action="<?= base_url(); ?>/peserta/approve/<?= $d['id_peserta'] ?>">
              <button type="submit" class="btn btn-primary">Yes</button>
            </form>
            <button class="btn btn-secondary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">No</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- modal delete -->
<?php foreach ($data as $d) : ?>
  <div class="modal fade" id="deleteModal<?= $d['id_peserta'] ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body d-flex flex-column justify-content-center text-center">
          <div class="icon-modal">
            <i class="fa-solid fa-circle-exclamation"></i>
          </div>
          <div class="text-body-modal">
            Are you sure want to delete this data?
          </div>
          <div class="modal-footer" style="justify-content: center; gap: 16px">
            <form class="d-inline" method="post" action="<?= base_url(); ?>/peserta/delete/<?= $d['id_peserta'] ?>">
              <button type="submit" class="btn btn-primary">Yes</button>
            </form>
            <button class="btn btn-secondary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">No</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?= $this->endSection() ?>