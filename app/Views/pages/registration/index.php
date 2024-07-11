<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<section class="d-flex justify-content-center">
  <div class="card" style="width: 40rem;">
    <div class="card-body">
      <h5 class="mb-3">Registration</h5>

      <form enctype="multipart/form-data" action="<?php echo base_url(); ?>register/submit" method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="example">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="******">
        </div>

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

        <div class="d-flex justify-content-between align-items-center">
          <div>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <div>
            Sudah punya akun? <a href="/login">Login!</a>
          </div>
        </div>

      </form>
    </div>
  </div>
</section>
<?= $this->endSection() ?>