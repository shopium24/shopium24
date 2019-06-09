<?php

use panix\engine\Html;


?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>

            </tr>
            <?php foreach ($response as $data) {


                ?>
                <tr>
                    <td><?= Html::a($data, $data); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>