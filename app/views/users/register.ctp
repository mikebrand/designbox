<div class = "container small">
<div class="users form">

<?php echo $this->Form->create('User');?>
	<fieldset>
<div id = "imgContainer"><img src = "/img/create.png"></div>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password',array('value'=>''));
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('betacode',array('label'=>'Beta Code'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Register Account', true));?>
</div>
</div>