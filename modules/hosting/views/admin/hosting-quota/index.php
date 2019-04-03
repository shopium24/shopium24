<?php

use panix\engine\Html;

echo Html::a('info', ['/admin/hosting/hosting-quota/info'], ['class' => 'btn btn-default']);
echo Html::a('used_ftp', ['/admin/hosting/hosting-quota/used-ftp'], ['class' => 'btn btn-default']);
echo Html::a('used_mysql', ['/admin/hosting/hosting-quota/used-mysql'], ['class' => 'btn btn-default']);


