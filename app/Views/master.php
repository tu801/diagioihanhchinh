<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?=base_url()?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <title>Hello, world!</title>
  </head>
  <body>
    <!-- CONTENT BEGINS -->
    <?= $this->renderSection('content') ?>
    <!-- CONTENT ENDS -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?=base_url()?>/bootstrap/js/bootstrap.bundle.min.js" ></script>

    <?= $this->renderSection('pageScripts') ?>
  </body>
</html>