<?php

use panix\engine\Html;
use yii\widgets\Breadcrumbs;


\app\web\themes\shopium24\ThemeAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <?php echo $this->render('partials/header'); ?>
       <?= $content ?>
        <?php



    echo $this->render('partials/footer'); ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
