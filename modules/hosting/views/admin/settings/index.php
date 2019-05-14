<?php

use panix\engine\Html;
use panix\engine\bootstrap\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-header">
            <h5><?= $this->context->pageName ?></h5>
        </div>
        <div class="card-body">
            <?= $form->field($model, 'auth_login') ?>
            <?= $form->field($model, 'auth_token') ?>
            <?= $form->field($model, 'account') ?>
        </div>
        <div class="card-footer text-center">
            <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>