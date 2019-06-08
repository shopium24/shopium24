<?php

use panix\engine\bootstrap\ActiveForm;
use panix\engine\Html;
use panix\ext\taginput\TagInput;

$form = ActiveForm::begin();
?>


<?= $form->field($model, 'domain')->dropDownList($selectOptions,['multiple'=>'multiple']); ?>


<?=
        $form->field($model, 'name')
        ->widget(TagInput::class, ['placeholder' => 'E-mail'])
        ->hint('Введите E-mail и нажмите Enter');
?>

<div class="text-center">
    <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>









		<?php if ($checkData) { ?>
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<tr>
							<th class="text-center">Домен</th>
							<th class="text-center">Состояние</th>
							<th class="text-center">Домен</th>
							<th class="text-center">Комментарий</th>
						</tr>
						<?php foreach ($checkData as $d => $result) { ?>
							<tr>
								<td><?= $d ?></td>
								<td class="text-center"><?php echo $result[0]['available'] ? '<span class="badge badge-success">доступен</span>' : '<span class="badge badge-secondary">не доступен</span>'; ?></td>
								<td class="text-center"><?php echo (isset($result[0]['reason'])) ? '<span class="text-danger">' . $result[0]['reason'] . '<span>' : '---'; ?></td>
								<td class="text-center"><?php echo $api->reasonCode($result[0]); ?></td>
								</tr>
						<?php } ?>
					</table>
				</div>
			<?php } ?>
