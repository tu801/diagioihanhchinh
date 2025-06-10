<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


  <title>Hello, world!</title>

  <script type="text/javascript">
    var site_url = '<?= base_url() ?>';
  </script>

</head>

<body>
  <!-- CONTENT BEGINS -->
  <?= $this->renderSection('content') ?>
  <!-- CONTENT ENDS -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="<?= base_url() ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url() ?>/plugins/select2/js/select2.full.min.js"></script>
  <script src="<?= base_url() ?>/areaLocation.js"></script>

  <?= $this->renderSection('pageScripts') ?>
</body>

</html>