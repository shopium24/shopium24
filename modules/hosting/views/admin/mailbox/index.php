<?php

use panix\engine\Html;


print_r($limits['notes']);
$this->registerJs("$('[data-toggle=\"tooltip\"]').tooltip();");
?>

<div class="card">
    <div class="card-header">
        <h5>Лимиты</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <td>Дневной лимит на отправку писем с веб-сервера без авторизации, напр. php-функцией mail()</td>
                <td>
                    <?= Yii::t('hosting/default', 'MAILBOX_LIMITS_COUNT', [
                        'count' => $limits['data']['mail_auth_daily_sent'],
                        'count2' => $limits['data']['mail_auth_daily_limit']
                    ]); ?>
                </td>
            </tr>
            <tr>
                <td>Дневной лимит на отправку сообщений посредством SMTP сервера</td>
                <td>
                    <?= Yii::t('hosting/default', 'MAILBOX_LIMITS_COUNT', [
                        'count' => $limits['data']['mail_daily_sent'],
                        'count2' => $limits['data']['mail_daily_limit']
                    ]); ?>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Email</th>
                <th class="text-center">Пароль</th>
                <th class="text-center">Тип</th>
                <th class="text-center">Антиспам</th>
                <th class="text-center">Перенапровление</th>
                <th class="text-center">Авто ответчик</th>
                <th class="text-center">Опции</th>
            </tr>
            <?php foreach ($response as $data) { ?>

                <?php $this->registerJs("common.clipboard('#clipboard_{$data['id']}');", yii\web\View::POS_READY, 'mailbox' . $data['id']); ?>
                <tr>
                    <td class="text-center"><?= $data['id'] ?></td>
                    <td><?= Html::mailto($data['name'], $data['name']) ?></td>
                    <td class="text-center">

                <span id="clipboard_<?= $data['id'] ?>" data-clipboard-text="<?= $data['password'] ?>"
                      data-toggle="tooltip" title="Нажмите, чтобы скопировать строку в буфер обмена"
                      style="cursor: pointer;">
                    <?= $data['password'] ?>
                </span>
                    </td>
                    <td class="text-center"><?= $data['type'] ?></td>
                    <td class="text-center"><?= $data['autospam'] ?></td>
                    <td class="text-center"><?= implode('<br/>', $data['forward']); ?></td>
                    <td class="text-center">
                        <?php if ($data['autoresponder']['enabled']) { ?>
                            <?= $data['autoresponder']['title']; ?>
                            <?= $data['autoresponder']['text']; ?>
                        <?php } else { ?>
                            <span class="badge badge-secondary">Откл.</span>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <?= Html::a(Html::icon('edit'), ['edit', 'email' => $data['name']], ['class' => 'btn btn-outline-secondary']) ?>
                            <?= Html::a(Html::icon('refresh'), ['clear', 'email' => $data['name']], ['class' => 'btn btn-outline-secondary']) ?>
                            <?= Html::a(Html::icon('delete'), ['delete', 'email' => $data['name']], ['class' => 'btn btn-outline-danger']) ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>