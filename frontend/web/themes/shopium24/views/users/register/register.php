<?php
Yii::import('mod.plans.models.Plans');
?>





<div class="col col-lg-6 offset-lg-3">







    <div class="progress">
        <div class="progress-bar bg-success" role="progressbar " style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
    </div>
    <div class="progress">
        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
    </div>
    <div class="progress">
        <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-danger " role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <div class="alert alert-success">
        asddsasda
    </div>


    <div class="alert alert-danger">
        asddsasda
    </div>

    <div class="alert alert-primary">
        asddsasda
    </div>

    <div class="alert alert-info">
        asddsasda
    </div>

    <div class="alert alert-warning">
        asddsasda
    </div>





    <div class="row">
    <div class="mt-4 mb-4 offset-sm-4 col-sm-8">
    <h2><?= $this->pageName; ?></h2>
    <p class="text-muted">Заполните пожалуйста поля ниже</p>
    </div>
    </div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-register-form',
        'enableAjaxValidation' => true, // Disabled to prevent ajax calls for every field update
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'errorCssClass' => 'has-error',
            'successCssClass' => 'has-success',
        ),
        'htmlOptions' => array('class' => '')
    ));
    ?>

    <?php
     echo $form->errorSummary($user, '', null, array('class' => 'errorSummary alert alert-danger'));
    ?>
    <div class="form-group row">
        <?= $form->labelEx($user, 'login', array('class' => 'col-form-label col-sm-4')); ?>
        <div class="col-sm-8">
            <?= $form->textField($user, 'login', array('class' => 'form-control')); ?>
            <?= $form->error($user, 'login'); ?>
        </div>
    </div>
    <div class="form-group row">
       <?= $form->labelEx($user, 'plan', array('class' => 'col-form-label col-sm-4')); ?>
        <div class="col-sm-8">
            <?php if ($user->plan && in_array($user->plan, array_values($user::getPlansList()))) { ?>
                <div class="input-group">
                    <?= $user->plan; ?>
                    <?= $form->hiddenField($user, 'plan', array('value' => $user->plan)); ?>
                </div>
                <?= $form->error($user, 'plan'); ?>
            <?php } else { ?>
                <div class="input-group">
                    <?= $form->dropdownlist($user, 'plan', CHtml::listData(Plans::model()->findAll(), 'name', 'name'), array('class' => 'form-control')); ?>
                    <div class="input-group-addon" style="display:none">
                        <?php $this->widget('mod.users.widgets.design.SelectDesginWidget'); ?>
                    </div>
                </div>
                <?= $form->error($user, 'plan'); ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group row">
       <?= $form->labelEx($user, 'subdomain', array('class' => 'col-form-label col-sm-4')); ?>
        <div class="col-sm-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">www</div>
                </div>

                <?= $form->textField($user, 'subdomain', array('class' => 'form-control')); ?>
                <div class="input-group-append"><div class="input-group-text"><?= Yii::app()->params['domain'] ?></div></div>
            </div>
            <?= $form->error($user, 'subdomain'); ?>
        </div>
    </div>
    <div class="form-group row">
        <?= $form->labelEx($user, 'username', array('class' => 'col-form-label col-sm-4')); ?>
        <div class="col-sm-8">
            <?= $form->textField($user, 'username', array('class' => 'form-control')); ?>
            <?= $form->error($user, 'username'); ?>
        </div>
    </div>
    <div class="form-group row">
        <?= $form->labelEx($user, 'password', array('class' => 'col-form-label col-sm-4')); ?>
        <div class="col-sm-8">
            <?= $form->passwordField($user, 'password', array('class' => 'form-control')); ?>
            <?= $form->error($user, 'password'); ?>
        </div>
    </div>
    <div class="form-group row">
        <?= $form->labelEx($user, 'confirm_password', array('class' => 'col-form-label col-sm-4')); ?>
        <div class="col-sm-8">
            <?= $form->passwordField($user, 'confirm_password', array('class' => 'form-control')); ?>
            <?= $form->error($user, 'confirm_password'); ?>
        </div>
    </div>
    <?php if (CCaptcha::checkRequirements() && false) { ?>
        <div class="form-group row">
            <?= $form->labelEx($user, 'verifyCode', array('class' => 'info-title')); ?>
            <?php
            $this->widget('CCaptcha', array(
                'clickableImage' => false,
                'showRefreshButton' => true,
                'buttonLabel' => '',
                'buttonOptions' => array(
                    'class' => 'refresh_captcha icon-loop-2'
                )
            ));
            ?>
            <? //= $form->textField($user, 'verifyCode', array('style' => 'width:150px', 'class' => 'form-control unicase-form-control text-input', 'placeholder' => $user->getAttributeLabel('verifyCode'))); ?>
        </div>
    <?php } ?>

    <div class="form-group row">
        <div class="col-sm-4"></div>
        <div class="col-sm-8"><?= $form->checkBox($user, 'terms', array('class' => '')); ?>
            <?= $form->labelEx($user, 'terms', array()); ?>
            <?= $form->error($user, 'terms'); ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4"></div>
        <div class="col-sm-8">
            <div class="text-center">
                <?= Html::submitButton(Yii::t('UsersModule.default', 'BTN_REGISTER'), array('class' => 'btn btn-lg btn-primary')); ?>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>




