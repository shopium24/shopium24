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
                <th class="text-center">ID</th>
                <th class="text-center">name</th>
                <th class="text-center">Размер</th>
                <th class="text-center">Таблиц</th>
                <th class="text-center">Опции</th>
            </tr>
            <?php foreach ($response as $data) { ?>
                <tr>
                    <td><?= $data['id'] ?></td>
                    <td><?= $data['name'] ?>
                        <?php foreach ($data['users'] as $user) { ?>
                            <div>
                                <b>Пользователь</b> <?= $user['login'] ?>
                                <div class="btn-group">
                                    <?= Html::a(Html::icon('delete'), ['user-delete22', 'user' => $user['login']], ['class' => 'btn btn-sm btn-secondary']); ?>
                                </div>
                            </div>
                            <div><b>Пароль</b> <?= $user['password'] ?></div>
                            <div><b>Привелегии</b> <?= implode(', ', $user['privileges']); ?></div>
                        <?php } ?>
                    </td>
                    <td class="text-center"><?= $data['size'] ?></td>
                    <td class="text-center"><?= $data['tables_count'] ?></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                        <?= Html::a(Html::icon('delete'), ['database-delete', 'database' => $data['name']], ['class' => 'btn btn-outline-secondary']); ?>
                        <?= Html::a(Html::icon('key'), ['user-password', 'user' => $data['name']], ['class' => 'btn btn-outline-secondary']); ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>