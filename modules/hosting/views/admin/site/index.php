<?php

use panix\engine\Html;
use panix\engine\CMS;

//CMS::dump($response);die;
?>

<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <?php foreach ($response as $site => $data) { ?>
                <tr>
                    <th class="text-center bg-dark text-white" colspan="5"><?= $data['name'] ?></th>
                </tr>
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
                            <?= Html::a(Html::icon('delete'), ['delete', 'site' => $data['name'], 'subdomain' => $host['name']], ['class' => 'btn btn-outline-danger']); ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
</div>
