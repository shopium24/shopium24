<div class="alert alert-info">
    Вы можете зарегистрировать и проверить наличие вашего будущего домен у нашего <a href="/html/domain">партнера</a>
</div>
<div class="alert alert-warning">
    Ваш домен должен находится на NS серверх указаных выше. (demo)
</div>
<ul class="list-group">
    <li class="list-group-item">NS сервера 

        <div class="pull-right">
            <div><span class="label label-success">ns118.inhostedns.com</span></div>
            <div><span class="label label-success">ns218.inhostedns.net</span></div>
            <div><span class="label label-success">ns318.inhostedns.org</span></div>
        </div>
        <div class="clearfix"></div>
    </li>
</ul>



<?php
Yii::import('mod.plans.models.Plans');

        
?>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-register-form',
           // 'enableAjaxValidation' => true, // Disabled to prevent ajax calls for every field update
            //'enableClientValidation' => false,
            'clientOptions' => array(
              //  'validateOnSubmit' => true,
               // 'validateOnChange' => true,
                'errorCssClass' => 'has-error',
                'successCssClass' => 'has-success',
            ),
            'htmlOptions' => array('class' => 'form-horizontal')
                ));
        ?>

        <?php
        echo $form->errorSummary($model, '<i class="fa fa-warning fa-3x"></i>', null, array('class' => 'errorSummary alert alert-danger'));
        ?>
        <div class="form-group ">
            <div class="col-sm-5"><?= $form->labelEx($model, 'domain', array('class' => 'control-label')); ?></div>
            <div class="col-sm-7">
                <?= $form->textField($model, 'domain', array('class' => 'form-control')); ?>
                <?= $form->error($model, 'domain'); ?>
            </div>
        </div>

        <div class="text-center">
            <?= Html::submitButton(Yii::t('default', 'SAVE'), array('class' => 'btn btn-lg btn-primary')); ?>
        </div>
        <?php $this->endWidget(); ?>
   




