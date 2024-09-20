<!-- Libs JS -->
<!-- Tabler Core -->
<script src="<?= Routes::assets('dist/js/tabler.min.js?1692870487') ?>" defer></script>
<script src="<?= Routes::assets('dist/js/demo.min.js?1692870487') ?>" defer></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_SESSION['gagal'])) : ?>
  <script>
    Swal.fire({
      title: "Gagal!",
      text: "<?= $_SESSION['gagal'] ?>",
      icon: "error"
    });
  </script>
  <?php unset($_SESSION['gagal']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['berhasil'])) : ?>
  <script>
    Swal.fire({
      title: "Berhasil!",
      text: "<?= $_SESSION['berhasil'] ?>",
      icon: "success"
    });
  </script>
  <?php unset($_SESSION['berhasil']); ?>
<?php endif; ?>



</body>

</html>