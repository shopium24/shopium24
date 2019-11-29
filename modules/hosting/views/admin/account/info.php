<?php

//\panix\engine\CMS::dump($response);
?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">valid_untill</th>
                <th class="text-center">plan</th>
            </tr>
            <?php foreach ($response as $id => $data) { ?>
                <tr>
                    <td class="text-center"><?= $data['id']; ?></td>
                    <td class="text-center">
                        <?= $data['valid_untill']; ?>
                    </td>
                    <td class="text-center">
                        <?= $data['plan']['name']; ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

