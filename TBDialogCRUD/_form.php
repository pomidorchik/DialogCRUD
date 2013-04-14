<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php if (Yii::app()->request->isAjaxRequest): ?>\n"; ?>
<div class="modal-header">
	<a class="close" data-dismiss="modal">&times;</a>
	<h4><?php echo "<?php echo \$model->isNewRecord ? 'Create ".$this->modelClass."' : 'Update ".$this->modelClass." #'.\$model->".$this->tableSchema->primaryKey." ?>"; ?></h4>
</div>

<div class="modal-body">
<?php echo "<?php endif; ?>" ?>



<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<?php echo "<?php echo ".$this->generateActiveRow($this->modelClass,$column)."; ?>\n"; ?>

<?php
}
?>
	<?php echo "<?php if (!Yii::app()->request->isAjaxRequest): ?>\n"; ?>
	<div class="form-actions">
		<?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>\$model->isNewRecord ? 'Create' : 'Save',
		)); ?>\n"; ?>
	</div>
	<?php echo "<?php endif; ?>"; ?>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

<?php echo "<?php if (Yii::app()->request->isAjaxRequest): ?>\n"; ?>
</div>

<div class="modal-footer">
    <?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>\$model->isNewRecord ? 'Создать' : 'Сохранить изменения',
        'url'=>'#',
		'htmlOptions'=>array(
			'id'=>'submit-'.mt_rand(),
			'ajax' => array(
				'url'=>\$model->isNewRecord ? \$this->createUrl('create') : \$this->createUrl('update', array('id'=>\$model->".$this->tableSchema->primaryKey.")),
				'type'=>'post',
				'data'=>'js:$(this).parent().parent().find(\"form\").serialize()',
				'success'=>'function(r){
					if(r==\"success\"){
						window.location.reload();
					}
					else{
						$(\"#TBDialogCrud\").html(r).modal(\"show\");
					}
				}', 
			),
		),
    )); ?>\n"; ?>
    <?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Закрыть',
        'url'=>'#',
        'htmlOptions'=>array(
			'id'=>'btn-'.mt_rand(),
			'data-dismiss'=>'modal'
		),
    )); ?>\n"; ?>
</div>
<?php echo "<?php endif; ?>"; ?>