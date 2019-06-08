<?php

use panix\engine\bootstrap\ActiveForm;
use panix\engine\Html;

?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'account')->dropDownList($model->getAccounts()); ?>
        <div class="form-group text-center">
            <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>



        <?php
        if ($response) {
            echo Html::a('access-edit', ['access-edit', 'account' => $model->account], ['class' => 'btn btn-secondary']);
            ?>
            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Логин</th>
                    <th class="text-center">Пароль</th>
                    <th class="text-center">Каталог доступа</th>
                    <th class="text-center">Только для чтения</th>
                    <th class="text-center"><?= Yii::t('app', 'OPTIONS'); ?></th>
                </tr>
                <?php foreach ($response as $data) { ?>
                    <tr>
                        <td class="text-center"><?= $data['id'] ?></td>
                        <td class="text-center"><?= $data['login'] ?></td>
                        <td class="text-center"><?= $data['password'] ?></td>
                        <td><?= (!empty($data['homedir'])) ? $data['homedir'] : 'root'; ?></td>
                        <td class="text-center">
                            <?php
                            if ($data['readonly']) {
                                $class = 'default';
                                $text = Yii::t('app', 'YES');
                            } else {
                                $class = 'success';
                                $text = Yii::t('app', 'NO');
                            }
                            ?>
                            <span class="label label-<?= $class ?>"><?= $text ?></span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <?= Html::a(Html::icon('edit'), ['create', 'account' => $model->account, 'login' => $data['login']], ['class' => 'btn btn-outline-secondary']); ?>
                                <?= Html::a(Html::icon('delete'), ['delete', 'account' => $model->account, 'ftp' => $data['login']], ['class' => 'btn btn-outline-secondary']); ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>
</div>






