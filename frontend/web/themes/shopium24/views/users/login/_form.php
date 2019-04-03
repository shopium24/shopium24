<?php
echo Html::form($this->createUrl('/users/login'), 'post', array('id' => 'user-login-form', 'class' => 'form'));

if ($model->hasErrors())
    Yii::app()->tpl->alert('danger', Html::errorSummary($model));
?>
<div class="form-group form-group-auto">
    <?=
    Html::activeTextField($model, 'login', array(
        'class' => 'form-control',
        'placeholder' => $model->getAttributeLabel('login')
    ));
    ?>
</div>

<div class="form-group form-group-auto">
    <?= Html::activePasswordField($model, 'password', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password'))); ?>
</div>


<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <?= Html::activeCheckBox($model, 'rememberMe', array('class' => 'form-control2')); ?>
            <?= Html::activeLabel($model, 'rememberMe'); ?>
        </div>
    </div>
    <div class="col-xs-6 text-right">
        <ul class="list-unstyled">
            <li><?= Html::link(Yii::t('UsersModule.default', 'REMIN_PASS'), array('/users/remind')) ?></li>
            <li><?= Html::link(Yii::t('UsersModule.default', 'BTN_REGISTER'), array('/users/register')) ?></li>
        </ul>
    </div>
</div>
<?php if (!Yii::app()->request->isAjaxRequest) { ?>
    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('UsersModule.default', 'BTN_LOGIN'), array('class'=>'btn btn-primary')); ?>
    </div>
<?php } ?>


<?php echo Html::endForm(); ?>

