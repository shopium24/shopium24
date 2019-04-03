<?php

use panix\engine\Html;
use yii\widgets\Breadcrumbs;


\app\frontend\web\themes\shopium24\assets\ThemeAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php echo $this->render('partials/header'); ?>
<div class="container-breadcrumb">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">

               bc

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h1 class="text-right mt-3"><?= $this->context->pageName ?></h1>
            </div>
        </div>
    </div>

</div>
<div class="bg-white" style="margin-bottom:100px">


                <?= $content ?>



</div>
<?php echo $this->render('partials/footer'); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>