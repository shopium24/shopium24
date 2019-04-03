<?php

use panix\engine\Html;

echo Html::a('info', ['/admin/hosting/hosting-database/info'], ['class' => 'btn btn-default']);
echo Html::a('DatabaseCreate', ['/admin/hosting/hosting-database/database-create'], ['class' => 'btn btn-default']);
echo Html::a('user_privileges', ['/admin/hosting/hosting-database/user-privileges'], ['class' => 'btn btn-default']);



