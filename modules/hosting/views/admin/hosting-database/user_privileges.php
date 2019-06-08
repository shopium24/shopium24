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
        <?= $form->field($model, 'database')->textInput() ?>
        <?= $form->field($model, 'user')->textInput() ?>
        <?= $form->field($model, 'privileges')->dropDownList($model->getPrivilegesList(), ['multiple' => 'multiple']); ?>
    </div>
    <div class="card-footer text-center">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>


