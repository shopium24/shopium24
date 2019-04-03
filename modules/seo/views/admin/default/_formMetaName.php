

<div class="form-group">
    <div class="col-sm-4"><?php echo $model->name; ?></div>
    <div class="col-sm-8">

        <?php if ($model->name == "keywords") { ?>
            <?php
            $this->widget('ext.taginput.TagInput', array(
                'model' => $model,
                'attribute' => "[$model->name]content",
                'htmlOptions' => array(
                    "size" => 60,
                )
            ));
            ?>

        <?php } else { ?>
            <?= Html::activeTextField($model, "[$model->name]content", array("size" => 60, 'class' => 'form-control')); ?>
        <?php } ?>
        <?php echo Html::error($model, "[$model->name]content"); ?></div>
</div>

<div class="form-group">
    <div class="col-sm-4"></div>
    <div class="col-sm-8"><?php //echo CHtml::dropDownList('title_param', "[$model->name]param", CHtml::listData($this->getParams(), "value", "name", "group"), array("empty" => "Свойства", 'class' => 'selectpicker addparams', 'data-id' => $model->id)); ?>
        <?php
       // echo $this->renderPartial('_formMetaParams', array('model' => $model));
        ?></div>
</div>



