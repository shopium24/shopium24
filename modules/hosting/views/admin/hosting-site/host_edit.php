<?php

use panix\engine\bootstrap\ActiveForm;
use panix\engine\Html;

/**
 * @var $model \app\modules\hosting\forms\hosting_site\HostSiteConfigWSForm
 */
$form = ActiveForm::begin();
?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">

        <?= $form->field($model, 'disable_service_url')->checkbox() ?>
        <?= $form->field($model, 'default_host')->checkbox() ?>
        <?= $form->field($model, 'document_root_suffix')->textInput() ?>
        <?= $form->field($model, 'ip')->textInput() ?>

        <?= $form->field($model, 'default_ip')->checkbox() ?>


        <?= $form->field($model, 'php_mail')->textInput() ?>
        <?= $form->field($model, 'modsecurity_enabled')->checkbox() ?>

    </div>
    <div class="card-footer text-center">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>


