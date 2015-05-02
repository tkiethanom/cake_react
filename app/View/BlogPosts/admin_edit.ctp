<div class="container">
	<form action="" method="post">
		<?php echo $this->Form->input($model.'.id'); ?>
		<div class="form-group">
			<?php echo $this->Form->input($model.'.title', array('class'=>'form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input($model.'.content', array('type'=>'textarea', 'class'=>'form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input($model.'.date', array('type'=>'text', 'class'=>'form-control datetimepicker' )  ); ?>
		</div>

		<input type="submit" class="btn btn-default" value="Submit"/>
		<a class='btn btn-default' href="/admin/<?php echo $this->params['controller'] ?>" >Cancel</a>
	</form>
</div>