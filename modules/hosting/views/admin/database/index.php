<?php

use panix\engine\Html;

?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-center">База данных</th>
                <th class="text-center">Пользователи</th>
                <th class="text-center">Размер</th>
                <th class="text-center">Таблиц</th>
                <th class="text-center"><?= Yii::t('app','OPTIONS');?></th>
            </tr>
            <?php foreach ($response as $data) { ?>
                <tr>
                    <td class="text-center"><?= $data['name'] ?></td>
                    <td>
                        <?php foreach ($data['users'] as $user) { ?>
                            <div>
                                <b>Пользователь</b> <?= $user['login'] ?>
                                <div class="btn-group btn-group-sm">
                                    <?= Html::a(Html::icon('delete'), ['user-delete', 'user' => $user['login']], ['class' => 'btn btn-outline-secondary']); ?>
                                    <?= Html::a(Html::icon('key').'', ['user-password', 'user' => $user['login']], ['class' => 'btn btn-outline-secondary']); ?>
                                    <?= Html::a(Html::icon('123').' Настроить права доступа', ['user-privileges', 'user_id' => $user['id'], 'user' => $user['login'], 'database' => $data['name']], ['class' => 'btn btn-outline-secondary']); ?>

                                </div>
                            </div>
                            <div><b>Пароль</b> <?= $user['password'] ?></div>
                            <div><b>Привелегии</b> <?= implode(', ', $user['privileges']); ?></div>
                        <?php } ?>
                    </td>
                    <td class="text-center"><?= ($data['size']) ? $data['size'] : '0'; ?> MB</td>
                    <td class="text-center"><?= $data['tables_count'] ?></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <?= Html::a(Html::icon('delete'), ['database-delete', 'database' => $data['name']], ['class' => 'btn btn-outline-secondary']); ?>

                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="icon-menu"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?= Html::a(Html::icon('link').' phpMyAdmin', "https://phpmyadmin.adm.tools/signon.php?user={$user['login']}&password={$user['password']}&account=pix1", ['class' => 'dropdown-item','target'=>'_blank']); ?>
                                <?= Html::a(Html::icon('refresh').' Очистить базу данных', ['clear', 'user' => $data['name']], ['class' => 'dropdown-item']); ?>


                            </div>
                        </div>




                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>