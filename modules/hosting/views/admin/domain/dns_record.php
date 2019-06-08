<?php
use panix\engine\Html;

\yii\helpers\VarDumper::dump($response['notes'], 10, true);
?>
<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-center">Субдомен</th>
                <th class="text-center">Тип</th>
                <th class="text-center">Приоритет</th>
                <th class="text-center">Данные</th>
            </tr>
            <?php foreach ($response['data'] as $data) { ?>
                <tr>
                    <td><?= $data['record']; ?></td>
                    <td class="text-center"><?= $data['type']; ?></td>
                    <td class="text-center">
                        <?php if($data['type'] == 'MX'){ ?>
                            <?php if(!empty($data['priority'])){ ?>
                                <?= Html::textInput('dns[' . $data['id'] . '][priority]', $data['priority'],['class'=>'form-control w-auto m-auto text-center']); ?>
                            <?php } ?>
                        <?php } ?>

                    </td>
                    <td class="text-center"><?= Html::textInput('dns[' . $data['id'] . '][data]', $data['data'],['class'=>'form-control w-auto m-auto']); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>