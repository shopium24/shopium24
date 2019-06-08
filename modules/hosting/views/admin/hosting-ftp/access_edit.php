<?php

use panix\engine\bootstrap\ActiveForm;
use panix\engine\Html;
use panix\ext\taginput\TagInput;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <?= $form->field($model, 'account')->dropDownList($model->getAccounts(), ['disabled' => (Yii::$app->request->get('account')) ? true : false]); ?>
        <?=
        $form->field($model, 'ip')
            ->widget(TagInput::class, ['placeholder' => 'ip'])
            ->hint($model::t('HINT_IP'));
        ?>
        <?= $form->field($model, 'active')->checkbox(); ?>
        <?= $form->field($model, 'web_ftp')->checkbox(); ?>
    </div>
    <div class="card-footer text-center">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>






