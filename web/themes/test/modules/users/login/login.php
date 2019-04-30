

<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
    <div class="h3"><?= $this->pageName ?></div>
    <?php
    $this->renderPartial('_form', array('model' => $model));
    ?>
</div>
<?php
if (Yii::app()->hasComponent('eauth'))
    Yii::app()->eauth->renderWidget();
?>