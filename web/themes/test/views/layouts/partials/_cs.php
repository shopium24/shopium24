<?php
$min = YII_DEBUG ? '' : '.min';
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('bootstrap');
$cs->registerCssFile("https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600&amp;subset=cyrillic");
//$cs->registerCssFile("https://fonts.googleapis.com/css?family=Exo+2:400,300,200,500&subset=latin,cyrillic");

$cs->registerScriptFile($this->baseAssetsUrl . "/js/common.js");

//$cs->registerScriptFile($this->assetsUrl . "/js/jquery.backstretch.min.js");
$cs->registerScriptFile($this->assetsUrl . "/js/owl.carousel.min.js");
$cs->registerScriptFile($this->assetsUrl . "/js/wow.min.js");
//$cs->registerScriptFile($this->assetsUrl . "/js/script.js");

$cs->registerCssFile($this->assetsUrl . "/css/theme.css");
$cs->registerCssFile($this->assetsUrl . "/css/plan.css");
$cs->registerCssFile($this->assetsUrl . "/css/ui.css");
$cs->registerCssFile($this->assetsUrl . "/css/animate.min.css");
$cs->registerCssFile($this->assetsUrl . "/css/owl.carousel.css");

Yii::import('ext.notify.Notify');
Notify::register();
