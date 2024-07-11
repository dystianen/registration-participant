<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<section class="d-flex flex-column align-items-center justify-content-center">
  <?php if (session()->getFlashData('failed')) : ?>
    <div class="alert failed alert-danger" role="alert" style="width: 40rem;">
      <?php echo session("failed") ?>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashData('success')) : ?>
    <div class="alert success alert-success" role="alert" style="width: 40rem;">
      <?php echo session("success") ?>
    </div>
  <?php endif; ?>

  <div class="card" style="width: 40rem;">
    <div class="card-body">
      <h5 class="mb-3">Login</h5>

      <form enctype="multipart/form-data" action="<?php echo base_url(); ?>login/submit" method="post">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="******">
        </div>

        <button type="reset" class="btn btn-outline-secondary">Reset</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</section>
<?= $this->endSection() ?>