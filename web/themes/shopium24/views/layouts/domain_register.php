<?php $this->renderPartial('//layouts/partials/_cs'); ?>
<!DOCTYPE html>
<html lang="<?=Yii::app()->charset?>">
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
        <?php $this->renderPartial('//layouts/partials/header'); ?>
        <script>
            $(function () {
                $('.carousel').carousel({
                    interval: 12000
                });
            });    
        </script>
        
        <div class="container page-error" style="padding-bottom: 100px;padding-top: 100px">
            <div class="row text-center">
                
                <i class="icon-check text-success" style="font-size:155px;"></i>
                <h3>Ваш сайт регистрируется, пожалуйста подождите.</h3>
                <div class="help-block">Это может занять до 15 минут.</div>
            </div>
        </div>

        <?php $this->renderPartial('//layouts/partials/footer'); ?>
    </body>
</html>

