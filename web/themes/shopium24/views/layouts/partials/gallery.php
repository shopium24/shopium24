<?php
use panix\engine\Html;
$this->registerJs("
    $(function () {
        $(\"#owl-slider-gal\").owlCarousel({
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoPlay: true,
            slideSpeed: 1000
        });
    });
",\yii\web\View::POS_END);

?>

<div id="owl-slider-gal" class="owl-carousel owl-theme">

    <div class="item"><?php //echo Html::img($this->context->assetsUrl . '/images/banner-standard.jpg', array('class' => 'img-fluid')) ?></div>
    <div class="item"><?php //echo Html::img($this->context->assetsUrl . '/images/banner-basic.jpg',  array('class' => 'img-fluid')) ?></div>


</div>