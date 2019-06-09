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
        <?= $form->errorSummary($model); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => 16 - strlen(Yii::$app->settings->get('hosting', 'account')) - 1]) ?>
        <?= $form->field($model, 'collation')->dropDownList($model->collectionArray); ?>
        <?= $form->field($model, 'user_create')->checkbox(); ?>
    </div>
    <div class="card-footer text-center">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php if ($response) { ?>
    <?php if ($response['user']['status'] == 'success') { ?>
        <table class="table table-bordered table-striped">
            <tr>
                <th>user</th>
                <th>password</th>
                <th>опции</th>
            </tr>
            <tr>
                <td><?= $response['user']['login'] ?></td>
                <td><?= $response['user']['password'] ?></td>
                <td><?= Html::a('delete', ['database-delete', 'database' => $response['user']['login']]) ?></td>
            </tr>
        </table>
    <?php } ?>
<?php } ?>

