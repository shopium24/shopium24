<?php
use panix\engine\Html;

echo Html::a('check', ['check'], ['class' => 'btn btn-secondary']);
echo Html::a('zones', ['zones'], ['class' => 'btn btn-secondary']);
?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-center">Домен</th>
                <th class="text-center">Статус оплаты</th>
                <th class="text-center">Владелец</th>
                <th class="text-center">admin_c</th>
                <th class="text-center">tech_c</th>
                <th class="text-center">admtools_domain</th>
                <th class="text-center">redirect_status</th>
                <th class="text-center">redirect_url</th>
                <th class="text-center">email_redirect</th>
                <th class="text-center">email_redirect_active</th>
                <th class="text-center">parking_page_enabled</th>
                <th class="text-center">parking_page_content</th>
                <th class="text-center"><?= Yii::t('app', 'OPTIONS'); ?></th>
            </tr>
            <?php foreach ($response as $data) { ?>
                <tr>
                    <td><?= $data['name']; ?> <?= $data['id']; ?></td>
                    <td class="text-center"><?= (!empty($data['valid_untill'])) ? '<span class="text-dark">до ' . $data['valid_untill'] . '</span>' : '<small class="text-warning">Зарегистрирован не у нас</small>'; ?></td>
                    <td class="text-center"><?= Html::mailto($data['owner']); ?></td>
                    <td><?= $data['admin_c']; ?></td>
                    <td><?= $data['tech_c']; ?></td>
                    <td class="text-center"><?= ($data['admtools_domain'] == 'true') ? Yii::t('app', 'YES') : 'Зарегистрирован не у нас'; ?></td>
                    <td class="text-center"><?= $data['redirect_status']; ?></td>
                    <td class="text-center"><?= $data['redirect_url']; ?></td>
                    <td class="text-center"><?= Html::mailto($data['email_redirect']); ?></td>
                    <td><?= $data['email_redirect_active']; ?></td>
                    <td><?= $data['parking_page_enabled']; ?></td>
                    <td><?= $data['parking_page_content']; ?></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <?= Html::a(Html::icon('settings'), ['dns-record'], ['class' => 'btn btn-outline-secondary']); ?>
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </button>
                            <div class="dropdown-menu">
                                <?= Html::a('NS - найм сервера', ['dns-ns', 'domain' => $data['name']], ['class' => 'dropdown-item']); ?>
                            </div>

                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

