<div class="projects form">
<?php echo $this->Form->create('Connection');?>
	<fieldset>
		<legend><?php __('Who do you want to follow?'); ?></legend>
	<?php
		echo $this->Form->input('user');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
