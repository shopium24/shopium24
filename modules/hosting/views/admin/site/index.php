<?php

use panix\engine\Html;
use panix\engine\CMS;

//CMS::dump($response);die;
?>



<?php foreach ($response as $site => $data) { ?>
<div class="card">
    <div class="card-header">
        <h5><?= $data['name'] ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-center">Субдомены</th>
                <th class="text-center">Сайты</th>
                <th class="text-center">Сервисная ссылка</th>
                <th class="text-center">Алиасы</th>
                <th class="text-center"><?= Yii::t('app', 'OPTIONS'); ?></th>
            </tr>
                <?php foreach ($data['hosts'] as $host) { ?>
                    <tr>
                        <td class="text-center"><?= $host['name']; ?></td>
                        <td class="text-center"><?= Html::a($host['fqdn'], 'http://' . $host['fqdn'], ['target' => '_blank']); ?></td>
                        <td class="text-center">
                            <?php
                            if (isset($host['service'])) {
                                echo Html::a($host['service'], 'http://' . $host['service'], ['target' => '_blank']);;
                            }
                            ?>
                        </td>
                        <?php if (isset($host['aliases'])) { ?>
                            <td class="text-center">
                                <?= implode('<br/>', $host['aliases']); ?>
                            </td>
                        <?php } ?>
                        <td>
                            <?php if($host['name'] != 'www'){ ?>
                                <?= Html::a(Html::icon('delete'), ['delete', 'host' => $host['name'].'.'.$data['name']], ['class' => 'btn btn-sm btn-outline-danger']); ?>
                            <?php } ?>
                            <?php if($host['name'] != 'www'){ ?>
                                <?= Html::a(Html::icon('edit'), ['host-edit', 'host' => $host['name'].'.'.$data['name']], ['class' => 'btn btn-sm btn-outline-danger']); ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>

        </table>
    </div>
</div>
<?php } ?>