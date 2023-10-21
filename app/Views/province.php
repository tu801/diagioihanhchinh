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
            <div class="card card-promary">
                <div class="card-title">
                    <h2>province data</h2>
                </div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Name En</th>
                            <th>Full Name</th>
                            <th>Full Name En</th>
                            <th>Unit Name En</th>
                            <th>Unit Name En</th>
                        </tr>

                        <?php foreach ($data as $item): ?>
                        <tr>
                            <td><?=$item->id?></td>
                            <td><?=$item->code?></td>
                            <td><?=$item->name?></td>
                            <td><?=$item->name_en?></td>
                            <td><?=$item->full_name?></td>
                            <td><?=$item->full_name_en?></td>
                            <td><?=$item->unit_name?></td>
                            <td><?=$item->unit_name_en?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>