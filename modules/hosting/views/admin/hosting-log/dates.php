<?php

use panix\engine\Html;


?>
<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>

    </tr>
    <?php foreach ($response as $data) {


    ?>
        <tr>
            <td><?= Html::a($data,$data); ?></td>
        </tr>
    <?php } ?>
</table>
