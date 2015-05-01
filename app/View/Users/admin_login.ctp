<div class="container">
	<form action="" method="post">
		<div class="form-group">
			<?php echo $this->Form->input('User.email', array('type'=>'email', 'class'=>'form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input('User.password', array('type'=>'password', 'class'=>'form-control')); ?>
		</div>
		<input type="submit" class="btn btn-default" value="Submit"/>
	</form>
</div>