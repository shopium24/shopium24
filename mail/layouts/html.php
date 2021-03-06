<?php
use yii\helpers\Html;
$request = Yii::$app->request;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>"/>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style type="text/css">
            <?= file_get_contents(Yii::getAlias('@app/mail/assets').'/style.css'); ?>
        </style>
    </head>
    <body style="width: 600px">
    <?php $this->beginBody() ?>
    <?= $content ?>

    <hr/>
    <p><strong class="test">IP address:</strong> <?= $request->userIP; ?></p>
    <p><strong>UserAgent:</strong> <?= $request->userAgent; ?></p>
    <div class="footer">
        asdasdasdsadas
        <a href="#">adssdadsa</a>
    </div>
    <div class="header">
        asdasdasdsadas
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>