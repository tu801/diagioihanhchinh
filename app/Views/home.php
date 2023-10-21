<?php
echo $this->extend('master');
echo $this->section('content');

$errors = session()->getFlashdata();
?>
<div class="container">
    <?php if ( isset($errors) && !empty($errors) ) : ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    <?php print_r($errors); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <a href="<?=base_url('export-provice')?>" class="btn btn-primary">Export Province JSON</a>
            <a href="<?=base_url('export-districts')?>" class="btn btn-primary">Export Districts JSON</a>
            <a href="<?=base_url('export-wards')?>" class="btn btn-primary">Export Wards JSON</a>
            <div class="card card-promary">
                <div class="card-title">
                    <h2><?=$title ?? 'Data Content'?></h2>
                </div>
                <div class="card-body">
                    <select id="province" class="form-select" aria-label="Default select example">
                        <?php foreach($data as $item) : ?>
                        <option value="<?=$item->id?>" ><?=$item->full_name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts'); ?>
<script>

</script>
<?= $this->endSection() ?>