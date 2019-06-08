<?php

use panix\engine\Html;

//print_r($response);die;
?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>name</th>
                <th>info</th>
            </tr>
            <?php
            foreach ($response as $site => $data) {

                ?>
                <tr>
                    <td><?= $data['name'] ?></td>
                    <td>
                        <?php foreach ($data['hosts'] as $host) { ?>
                            <div><?= $host['name']; ?><br/></div>
                            <div><?= $host['fqdn']; ?><br/></div>
                            <div><?= Html::a($host['service'], 'http://'.$host['service']); ?><br/></div>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>