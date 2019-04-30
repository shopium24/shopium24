<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var panix\mod\user\models\User $user
 * @var bool $success
 * @var bool $invalidKey
 */

$this->title = Yii::t('user/default', 'Reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-reset">

	<h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($success)): ?>

        <div class="alert alert-success">

            <p><?= Yii::t("user/default", "Password has been reset") ?></p>
            <p><?= Html::a(Yii::t("user/default", "Log in here"), ["/user/login"]) ?></p>

        </div>

    <?php elseif (!empty($invalidKey)): ?>

        <div class="alert alert-danger">
            <p><?= Yii::t("user/default", "Invalid key") ?></p>
        </div>

	<?php else: ?>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'reset-form']); ?>

                    <?= $form->field($user, 'newPassword')->passwordInput() ?>
                    <?= $form->field($user, 'newPasswordConfirm')->passwordInput() ?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t("user/default", "Reset"), ['class' => 'btn btn-primary']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

	<?php endif; ?>

</div>