<?php $this->renderPartial('//layouts/partials/_cs'); ?>
<!DOCTYPE html>
<html lang="<?= Yii::app()->language ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?php if (Yii::app()->hasModule('seo')) { ?>
        <?php Yii::app()->seo->run(); ?>
    <?php } else { ?>
        <title><?= Html::encode($this->pageTitle) ?></title>
    <?php } ?>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <meta name="robots" content="all">
</head>
<body>
<?php
$this->widget('ext.admin.sitePanel.PanelWidget');
?>
<?php $this->renderPartial('//layouts/partials/header'); ?>
<div class="container-breadcrumb">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <?php
                $this->widget('Breadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'htmlOptions' => array('class' => 'breadcrumb'),
                    'separator'=>false
                ));
                ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h1 class="text-right mt-3"><?= $this->pageName ?></h1>
            </div>
        </div>
    </div>

</div>
<div class="bg-white" style="margin-bottom:100px">

        <div class="container">
            <div class="row">
                <?= $content ?>
            </div>
        </div>


</div>
<?php $this->renderPartial('//layouts/partials/footer'); ?>

</body>
</html>