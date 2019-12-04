<?php
use panix\engine\widgets\Pjax;

Pjax::begin([
    'id' => 'pages-view'
]);
?>
<h1><?= $model->isString('name'); ?></h1>


<div class="mce-content-body">
    <?= $model->renderText(); ?>
</div>


<?php Pjax::end(); ?>
<?php if(Yii::$app->hasModule('comments')) {?>
    <?= panix\mod\comments\widgets\comment\CommentWidget::widget(['model' => $model]); ?>
<?php } ?>
