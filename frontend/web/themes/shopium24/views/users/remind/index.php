
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
    <div class="h3"><?php echo $this->pageName; ?></div>
    <?php
    echo Html::form();
    echo Html::errorSummary($model, '<i class="fa fa-warning fa-3x"></i>', null, array('class' => 'errorSummary alert alert-danger'));
    ?>


    <?= Html::activeLabel($model, 'email', array('required' => true)); ?>

    <?php
    if (Yii::app()->user->hasFlash('success')) {
        echo Yii::app()->user->getFlash('success');
    }
    ?>
    <div class="form-group">
        <?= Html::activeTextField($model, 'email', array('placeholder' => $model->getAttributeLabel('email'), 'class' => 'form-control')); ?>
    </div>
    <br/>
    <input type="submit" class="btn btn-primary" value="<?php echo Yii::t('UsersModule.default', 'Напомнить'); ?>">
    <br/><br/>
    <ul class="list-unstyled">
        <li><? //= Html::link(Yii::t('UsersModule.default', 'REGISTRATION'), array('/users/register'));   ?></li>
        <li><? //= Html::link(Yii::t('UsersModule.default', 'AUTH'), array('/users/login'));   ?></li>
    </ul>

    <?= Html::endForm(); ?>
</div>