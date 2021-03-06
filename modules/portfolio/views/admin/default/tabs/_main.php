<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use panix\mod\shop\models\Manufacturer;
use panix\mod\shop\models\Category;
use panix\ext\tinymce\TinyMce;


?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
<?= $form->field($model, 'seo_alias')->textInput(['maxlength' => 255]) ?>


<?= $form->field($model, 'text')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],

]);
?>