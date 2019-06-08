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
                <th class="text-center">size</th>
                <th class="text-center">tables_count</th>
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
                                    <?= Html::a(Html::icon('delete'), ['/admin/hosting/hostingdatabase/user-delete22', 'user' => $user['login']], ['class' => 'btn btn-xs btn-secondary']); ?>
                                    <?= Html::a(Html::icon('key'), ['/admin/hosting/hostingdatabase/user-password', 'user' => $user['login']], ['class' => 'btn btn-xs btn-secondary']); ?>
                                </div>
                            </div>
                            <div><b>Пароль</b> <?= $user['password'] ?></div>
                            <div><b>Привелегии</b> <?= implode(', ', $user['privileges']); ?></div>
                        <?php } ?>
                    </td>
                    <td class="text-center"><?= $data['size'] ?></td>
                    <td class="text-center"><?= $data['tables_count'] ?></td>
                    <td>
                        <?= Html::a(Html::icon('delete'), ['/admin/hosting/hostingdatabase/database-delete', 'database' => $data['name']], ['class' => 'btn btn-secondary']); ?>
                        <?= Html::a('change-password', ['/admin/hosting/hostingdatabase/user-password', 'user' => $data['name']], ['class' => 'btn btn-secondary']); ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>