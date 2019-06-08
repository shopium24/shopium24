<?php

use panix\engine\bootstrap\ActiveForm;
use panix\engine\Html;

print_r($response['notes']);
?>
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h5><?= $this->context->pageName; ?></h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th class="text-center">NS</th>
                    </tr>
                    <?php foreach ($response['data'] as $data) { ?>
                        <tr>
                            <td><?= $data; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <?php $form = ActiveForm::begin(); ?>
        <div class="card">
            <div class="card-header">
                <h5>Сменить NS сервера</h5>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'ns1'); ?>
                <?= $form->field($model, 'ns2'); ?>
                <?= $form->field($model, 'ns3'); ?>
                <?= $form->field($model, 'ns4'); ?>
            </div>
            <div class="card-footer text-center">
                <?= Html::submitButton(Yii::t('app', 'UPDATE'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>