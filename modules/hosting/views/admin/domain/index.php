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
                <th class="text-center">admtools domain</th>
                <th class="text-center">Web редирект</th>
                <th class="text-center">Редирект почты</th>
                <th class="text-center">Парковочная страница</th>
                <th class="text-center"><?= Yii::t('app', 'OPTIONS'); ?></th>
            </tr>
            <?php foreach ($response as $data) { ?>
                <tr>
                    <td>[<?= $data['id']; ?>] <?= $data['name']; ?></td>
                    <td class="text-center"><?= (!empty($data['valid_untill'])) ? '<span class="text-dark">до ' . $data['valid_untill'] . '</span>' : '<small class="text-warning">Зарегистрирован не у нас</small>'; ?></td>
                    <td class="text-center"><?= Html::mailto($data['owner']); ?></td>
                    <td><?= $data['admin_c']; ?></td>
                    <td><?= $data['tech_c']; ?></td>
                    <td class="text-center"><?= ($data['admtools_domain'] == 'true') ? Yii::t('app', 'YES') : '<small class="text-warning">Зарегистрирован не у нас</small>'; ?></td>
                    <td class="text-center">
                        <?php if ($data['redirect_status'] == 'direct') {
                            $class = 'warning';
                        } elseif ($data['redirect_status'] == 'frames') {
                            $class = 'danger';
                        } else { //off
                            $class = 'secondary';
                        } ?>
                        <span class="badge badge-<?= $class; ?>"><?= $data['redirect_status']; ?></span>
                        <?= Html::a(\panix\engine\CMS::domain($data['redirect_url']), $data['redirect_url']); ?>
                    </td>

                    <td class="text-center">
                        <?= ($data['email_redirect_active']) ? '<span class="badge badge-success">' . Yii::t('app', 'ON') . '</span>' : '<span class="badge badge-secondary">' . Yii::t('app', 'OFF') . '</span>'; ?>
                        <?= Html::mailto($data['email_redirect']); ?>
                    </td>
                    <td class="text-center">
                        <?= ($data['parking_page_enabled']) ? '<span class="badge badge-success">' . Yii::t('app', 'ON') . '</span>' : '<span class="badge badge-secondary">' . Yii::t('app', 'OFF') . '</span>'; ?>
                        <?= $data['parking_page_content']; ?>
                    </td>
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

