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
        <?= $form->field($model, 'password')->textInput() ?>
    </div>
    <div class="card-footer text-center">
        <?= Html::submitButton(Yii::t('app', 'UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>


