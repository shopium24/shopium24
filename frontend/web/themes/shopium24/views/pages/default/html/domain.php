<?php
use app\modules\hosting\components\Api;
use app\modules\hosting\forms\domain\DomainCheckForm;
use panix\engine\bootstrap\ActiveForm;
use panix\engine\Html;
use panix\ext\taginput\TagInput;

$this->registerJs("
$(function () {
  $('[data-toggle=\"popover\"]').popover();
})
", \yii\web\View::POS_END);
$apiZones = new Api('dns_domain', 'zones', ['available' => 1]);
$checkData = [];
$stackDomain = [];
$model = new DomainCheckForm();

if ($model->load(Yii::$app->request->post()) && $model->validate()) {

    $domainArray = explode(',', $model->name);
    if (count($domainArray) <= 10) {
        foreach ($domainArray as $stack) {
            foreach ($model->domain as $domain) {
                $stackDomain[] = $stack . "." . $domain;
            }
        }
        $api = new Api('dns_domain', 'check', ['stack' => $stackDomain]); //array('stack' => array($model->name . "." . $model->domain))

        foreach ($api->response->data as $domain => $data) {
            $checkData[$domain][] = $data;
        }
    }
}

?>


<?php

function brandsort($a, $b)
{
    return strnatcmp($a->classname, $b->classname);
}

$array = array();
foreach ($apiZones->response->data as $data) {

    $array[$data->class->name][] = (object)array(
        'domain_name' => $data->name,
        'domain_price' => ($data->is_action) ? $data->price_action : $data->price,
        'original_price' => $data->price,
        'classname' => $data->class->name,
        'is_action' => $data->is_action,
        'action_comment' => $data->action_comment
    );
}
?>


<div class="container">
    <div class="row">
        <div class="col">
            <?php


            $form = ActiveForm::begin();
            ?>


            <h1>Проверка доменов</h1>

            <?=
            $form->field($model, 'name')
                ->widget(TagInput::class, ['placeholder' => 'Домен'])
                ->hint('Введите название домена и нажмите Enter');
            ?>

            <div class="form-group text-center">
                <?= Html::submitButton(Yii::t('hosting/default', 'CHECK'), ['class' => 'btn btn-success']) ?>
            </div>


            <?php if ($checkData) { ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th class="text-center">Домен</th>
                            <th class="text-center">Состояние</th>
                            <th class="text-center">Домен</th>
                            <th class="text-center">Комментарий</th>
                        </tr>
                        <?php foreach ($checkData as $domain => $result) { ?>
                            <tr>
                                <td>
                                    <?php
                                    if ($result[0]->available) {
                                        echo $domain;
                                    } else {
                                        echo Html::a($domain, '//' . $domain, ['target' => '_black']);
                                    }
                                    ?>
                                </td>
                                <td class="text-center"><?php echo $result[0]->available ? '<span class="badge badge-success">' . Yii::t('hosting/default', 'DOMAIN_AVAILABLE_FREE') . '</span>' : '<span class="badge badge-danger">' . Yii::t('hosting/default', 'DOMAIN_AVAILABLE_BUSY') . '</span>'; ?></td>
                                <td class="text-center">
                                    <?php echo (isset($result[0]->reason)) ? '<span class="text-danger">' . $result[0]->reason . '<span>' : '---'; ?></td>
                                <td class="text-center"><?php echo Api::reasonCode($result[0]); ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>

            <h2>Стоимость доменов</h2>
            <table class="table table-bordered">
                <?php foreach ($array as $key => $items) { ?>
                    <tr>
                        <th colspan="6" class="text-center bg-light"><?= $key ?></th>
                    </tr>
                    <?php
                    usort($items, 'brandsort');
                    $i = 0;
                    foreach ($items as $kz => $row) {
                        $i++;
                        ?>

                        <td class="<?= ($row->is_action) ? 'bg-danger2' : ''; ?> text-left">
                            <?php
                            if ($model->domain) {
                                $checked = (in_array($row->domain_name, $model->domain)) ? true : false;
                            } else {
                                $checked = false;
                            }
                            echo Html::checkbox('DomainCheckForm[domain][]', $checked, ['value' => $row->domain_name]);
                            ?>
                            <b><?= $row->domain_name ?></b>
                            <?php if ($row->is_action) { ?>
                                <i class="icon-discount text-info"
                                   data-toggle="popover"
                                   data-placement="right"
                                   data-trigger="hover"
                                   data-html="true"
                                   title="Скидка на <?= $row->domain_name; ?>"
                                   data-content="<?= $row->action_comment ?>"></i>

                            <?php } ?>

                        </td>
                        <td class="<?= ($row->is_action) ? 'bg-danger2' : ''; ?> text-center" style="width:10%;">
                            <?php if ($row->is_action) { ?>
                                <span class="text-success"><?= number_format($row->domain_price, 0, '', '') ?>
                                    грн.</span><br/>
                                <small class="text-danger"><span
                                            style="text-decoration: line-through;"><?= number_format($row->original_price, 0, '', '') ?></span>
                                    грн.
                                </small>
                            <?php } else { ?>
                                <span class="text-success"><?= number_format($row->original_price, 0, '', '') ?>
                                    грн.</span>
                            <?php } ?>

                        </td>

                        <?php if ($i % 3 == 0) { ?>
                            <tr></tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </table>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>