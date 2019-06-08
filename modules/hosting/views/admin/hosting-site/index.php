<?php

use panix\engine\Html;

?>

<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <?php foreach ($response as $site => $data) { ?>
                <tr>
                    <th class="text-center bg-dark text-white" colspan="4"><?= $data['name'] ?></th>
                </tr>
                <tr>
                    <th class="text-center">Субдомены</th>
                    <th class="text-center">Сайты</th>
                    <th class="text-center">Сервисная ссылка</th>
                    <th class="text-center">Алиасы</th>
                </tr>
                <?php foreach ($data['hosts'] as $host) { ?>
                    <tr>
                        <td class="text-center"><?= $host['name']; ?></td>
                        <td class="text-center"><?= Html::a($host['fqdn'], 'http://' . $host['fqdn'], ['target' => '_blank']); ?></td>
                        <td class="text-center"><?= Html::a($host['service'], 'http://' . $host['service'], ['target' => '_blank']); ?></td>
                        <?php if (isset($host['aliases'])) { ?>
                            <td class="text-center">
                                <?= implode('<br/>', $host['aliases']); ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
</div>
