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
", \yii\web\View::POS_END);
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
                        <li class="dropdown-item"><?= Html::a('Регистрация доменов', ['/page/domain']) ?></li>
                    </ul>
                </li>
                <li class="nav-item d-none"><a href="#" class="nav-link">Выкуп магазина</a></li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle nav-link" href="#" id="dropdown-user"
                                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?= Yii::$app->user->getDisplayName(); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-user">
                        <?php if(Yii::$app->user->isGuest){ ?>
                            <li class="dropdown-item"><?= Html::a(Yii::t('user/default','LOGIN'), ['/user/login']) ?></li>
                            <li class="dropdown-item"><?= Html::a(Yii::t('user/default','REGISTER'), ['/user/register']) ?></li>
                        <?php }else { ?>
                            <li class="dropdown-item"><?= Html::a(Yii::t('user/default','PROFILE'), ['/user/profile']) ?></li>
                            <li class="dropdown-item"><?= Html::a(Yii::t('user/default','LOGOUT'), ['/user/logout']) ?></li>
                        <?php } ?>

                    </ul>
                </li>
                <li class="nav-item"><?= Html::a(Yii::t('contacts/default', 'MODULE_NAME'), ['/contacts'], array('class' => 'nav-link')) ?></li>
            </ul>
        </div>


        <div class="my-2 my-md-0">
            <?php if (Yii::$app->user->isGuest) { ?>
                <?= Html::a('<i class="icon-add"></i> Создать магазин', ['/user/register'], ['class' => 'btn btn-lg btn-success']); ?>
            <?php } else { ?>
                <div class="float-right header-contacts text-right">
                    <div class="phone">
                        <i class="icon-phone"></i><span><?= Html::tel('+380682937379',[],'($2) $3-$4-$5'); ?></span>
                    </div>
                    <div class="email">
                        <i class="icon-envelope"></i><span><?= Html::mailto('support@' . Yii::$app->params['domain']); ?></span>
                    </div>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</nav>