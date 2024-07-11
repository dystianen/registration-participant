<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<section class="d-flex flex-column align-items-center justify-content-center min-vh-100" style="gap: 20px;">
  <img src="<?php echo base_url('/waiting-clock.svg') ?>" alt="waiting" width="200" height="200">
  <h5>Waiting approval from Admin!</h5>

  <button class="btn btn-warning" onclick="window.location.reload()">Refresh</button>
</section>
<?= $this->endSection() ?>