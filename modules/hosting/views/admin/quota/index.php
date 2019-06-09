<?php

use panix\engine\bootstrap\Tabs;

/**
 * @var $ftp \app\modules\hosting\components\Api
 * @var $mysql \app\modules\hosting\components\Api
 * @var $response \app\modules\hosting\components\Api
 */
?>

<?= $this->render('_graph', ['response' => $response]); ?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">

        <?php
        \yii\helpers\VarDumper::dump($response, 5, true);
        echo Tabs::widget([
            'items' => [
                [
                    'label' => 'FTP',
                    'content' => $this->render('_ftp', ['response' => $ftp]),
                    'active' => true
                ],
                [
                    'label' => 'MySQL',
                    'content' => $this->render('_mysql', ['response' => $mysql]),
                    'headerOptions' => [],
                    'options' => ['id' => 'myveryownID'],
                ],


            ],
        ]);
        ?>
    </div>
</div>

