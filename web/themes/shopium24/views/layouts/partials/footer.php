<footer class="footer">
    <div class="container">
        <div class="row wow animated fadeIn">
            <div class="col-lg-4">
                <?=
                Yii::t('app', 'COPYRIGHT', array(
                    'year' => date('Y'),
                    'site_name' => Yii::$app->settings->get('app', 'site_name')
                ))
                ?>
                <br/><br/>
                <div class="made-in-ukraine">
                    Made<br/>
                    In<br/>
                    Ukraine
                </div>
                {copyright}
            </div>
            <div class="col-lg-4">
                <ul class="list-group">
                    <li class="list-group-item"><a href="/html/plans">Цены</a></li>
                    <li class="list-group-item"><a href="/html/domain">Домены</a></li>
                    <li class="list-group-item"><a href="/page/terms">Условия использования</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul class="list-group">
                    <li class="list-group-item"><i class="icon-phone text-md"></i> <span class="text-md">+38 063 390 71 36</span></li>
                    <li class="list-group-item"><i class="icon-envelope text-md"></i> <span class="text-md">support@<?= Yii::$app->params['domain']; ?></span></li>

                </ul>

            </div>
        </div>
    </div>
</footer>

