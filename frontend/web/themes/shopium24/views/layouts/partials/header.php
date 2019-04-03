<?php
use panix\engine\Html;
$this->registerJs("
    $(document).ready(function () {
        $('.navbar-brand span').hover(function (e) {
            e.preventDefault();
            $(this).removeClass('swing');
        }, function () {
            $(this).addClass('swing');
        });
    });
",\yii\web\View::POS_END);
?>
<nav class="navbar navbar-expand-lg fixed-top bg-white">
    <div class="container">

        <a class="navbar-brand" href="/">
            <?= Yii::$app->settings->get('app', 'site_name') ?>
            <span class="animated swing"></span>
        </a>


        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
            <i class="icon-menu"></i>
        </button>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="/page/plans" class="nav-link">Цены</a></li>
                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" href="#" id="drop-service"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Услуги
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="drop-service">
                        <li class="dropdown-item"><?= Html::a('Регистрация доменов', array('/page/domain')) ?></li>
                    </ul>
                </li>
                <li class="nav-item" style="display:none;"><a href="#" class="nav-link">Выкуп магазина</a></li>

                <li class="nav-item"><?= Html::a('Контакты', array('/contacts'), array('class' => 'nav-link')) ?></li>
                <?php //$this->widget('mod.users.widgets.login.LoginWidget'); ?>
            </ul>
        </div>


        <div class="my-2 my-md-0">
            <?php if (Yii::$app->user->isGuest) { ?>
                <a href="/users/register" class="btn btn-lg btn-success"><i class="icon-add"></i> Создать магазин</a>
            <?php } else { ?>
                <div class="float-right header-contacts">
                    <div><i class="icon-phone"></i>
                        <span>+38 063 390 71 36</span><br/><span>+38 068 293 73 79</span></div>
                    <div><i class="icon-envelope"></i> <span>support@<?= Yii::$app->params['domain']; ?></span>
                    </div>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</nav>