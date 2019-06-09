<?php
use panix\engine\CMS;

?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-center">Домен</th>
                <th class="text-center">Размер</th>
                <th class="text-center">inode</th>
            </tr>
            <?php foreach ($response as $data) { ?>
                <tr>
                    <td><?= $data['name'] ?></td>
                    <td class="text-center"><?= CMS::fileSize($data['size'] * 1024); ?></td>
                    <td class="text-center"><?= $data['inode'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
