<?php

use panix\engine\bootstrap\Tabs;

/**
 * @var $ftp \app\modules\hosting\components\Api
 * @var $mysql \app\modules\hosting\components\Api
 */
?>

<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">

        <?php



        echo Tabs::widget([
            'items' => [
                [
                    'label' => Yii::t('hosting/default','QUOTA_FTP'),
                    'content' => $this->render('_ftp', ['response' => $ftp]),
                    'active' => true
                ],
                [
                    'label' => Yii::t('hosting/default','QUOTA_MYSQL'),
                    'content' => $this->render('_mysql', ['response' => $mysql]),
                    'headerOptions' => [],
                    'options' => ['id' => 'myveryownID'],
                ],


            ],
        ]);
        ?>
    </div>
</div>

