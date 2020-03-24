<?php
use panix\engine\Html;
?>
<footer class="footer">
    <div class="container">
        <div class="row wow animated fadeIn">
            <div class="col-lg-4">
                <?=
                Yii::t('app', 'COPYRIGHT', [
                    'year' => date('Y'),
                    'by' => Yii::$app->settings->get('app', 'sitename')
                ])
                ?>
                <br/><br/>
                <div class="made-in-ukraine">
                    Made In<br/>
                    Ukraine
                </div>
                {copyright}
            </div>
            <div class="col-lg-4">
                <ul class="list-group">
                    <li class="list-group-item"><?= Html::a('Цены',['/page/plans']); ?></li>
                    <li class="list-group-item"><?= Html::a('Домены',['/page/domain']); ?></li>
                    <li class="list-group-item"><?= Html::a('Условия использования',['/page/terms']); ?></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul class="list-group">
                    <li class="list-group-item"><i class="icon-phone text-md"></i> <span class="text-md">+38 063 390 71 36</span></li>
                    <li class="list-group-item"><i class="icon-envelope text-md"></i> <span class="text-md"><? \panix\engine\Html::mailto('support@'.Yii::$app->params['domain']); ?></span></li>

                </ul>

            </div>
        </div>
    </div>
</footer>

