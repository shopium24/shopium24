<?php

use panix\engine\bootstrap\ActiveForm;
use panix\engine\Html;
?>
<?php $form = ActiveForm::begin(); ?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">

        <?= $form->field($model, 'account')->dropDownList($model->getAccounts(), ['disabled' => (Yii::$app->request->get('account')) ? true : false]); ?>
        <?= $form->field($model, 'login')->textInput(['disabled' => (Yii::$app->request->get('login')) ? true : false,'maxlength' => 16 - strlen(Yii::$app->settings->get('hosting', 'account')) - 1]); ?>
        <?= $form->field($model, 'password')->hint($model::t('HINT_PASSWORD')); ?>
        <?= $form->field($model, 'homedir')->hint($model::t('HINT_HOMEDIR')); ?>
        <?= $form->field($model, 'readonly')->checkbox(); ?>


    </div>
    <div class="card-footer text-center">
        <?= Html::submitButton(Yii::t('app', 'CREATE'), ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>





