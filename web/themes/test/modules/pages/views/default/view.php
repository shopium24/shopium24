<?php if(Yii::app()->user->isSuperuser){ ?>

<div class="col-xs-12">
<h1><?= $model->isString('title'); ?></h1>
<?= $model->isArea('full_text'); ?>
</div>
<?php }else{ ?>

<?=Yii::app()->tpl->alert('info',Yii::t('error','401')); ?>
<?php } ?>




