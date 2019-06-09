<?php
use panix\engine\CMS;


?>

<table class="table table-bordered table-striped">
    <tr>
        <th>Домен</th>
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
