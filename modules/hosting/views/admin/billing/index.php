<?php

use panix\engine\Html;

?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <?php if ($response) { ?>
            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">ID/Number</th>
                    <th>Цель</th>
                    <th class="text-center">статус</th>
                    <th class="text-center">Дата</th>
                    <th class="text-center">Цена</th>
                    <th class="text-center">Возврат</th>
                    <th class="text-center">Опции</th>
                </tr>
                <?php foreach ($response as $id => $data) { ?>
                    <tr>
                        <td class="text-center"><?= $data['id']; ?> (<?= $data['number']; ?>)</td>
                        <td><?= $data['purpose']; ?></td>
                        <td class="text-center"><span class="badge badge-secondary"><?= $data['status']; ?></span></td>
                        <td class="text-center"><?= $data['date']; ?></td>
                        <td class="text-center"><?= $data['sum']; ?> <?= $data['currency']; ?></td>
                        <td class="text-center"><?= $data['refund']; ?></td>
                        <td class="text-center">
                            <?= Html::a(Html::icon('cart'), ['pay', 'invoice' => $data['id']], ['class' => 'btn btn-sm btn-secondary']) ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">Нет Инфы</div>
        <?php } ?>
    </div>
</div>

