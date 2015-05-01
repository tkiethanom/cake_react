<div class="container">
	<form action="" method="post">
		<?php echo $this->Form->input($model.'.id'); ?>
		<div class="form-group">
			<?php echo $this->Form->input($model.'.email', array('class'=>'form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input($model.'.password', array('type'=>'password', 'class'=>'form-control', 'required'=>false)); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input($model.'.confirm_password', array('type'=>'password', 'class'=>'form-control', 'required'=>false)); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input($model.'.active', array('type'=>'checkbox')); ?>
		</div>
		<input type="submit" class="btn btn-default" value="Submit"/>
		<a class='btn btn-default' href="/admin/<?php echo $this->params['controller'] ?>" >Cancel</a>
	</form>
</div>