<?php

use panix\engine\Html;

?>

<?php
$this->registerJs("$('[data-toggle=\"tooltip\"]').tooltip();");
?>


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
                    <td><?php print_r($data['autoresponder']) ?></td>
                    <td>
                        <?= Html::a(Html::icon('edit'), ['/admin/hosting/hostingmailbox/edit', 'email' => $data['name']]) ?>
                        <?= Html::a(Html::icon('refresh'), ['/admin/hosting/hostingmailbox/clear', 'email' => $data['name']]) ?>
                        <?= Html::a(Html::icon('delete'), ['/admin/hosting/hostingmailbox/delete', 'email' => $data['name']]) ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>