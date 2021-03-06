<?php

use panix\engine\bootstrap\ActiveForm;
use panix\engine\Html;

$form = ActiveForm::begin();
?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <?= $form->field($model, 'site')->dropDownList($model->getSiteList()); ?>
        <?= $form->field($model, 'subdomain')->textInput() ?>
    </div>
    <div class="card-footer text-center">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>


