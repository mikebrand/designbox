<div class = "small container">
<div class="projects form">
<?php echo $this->Form->create('Image', array('type' => 'file','action'=>'../pages/add'));?>
	<fieldset>
		<div id = "imgContainer"><img src = "/img/addpage.png"></div>
	<?php
		echo $this->Form->input('project_id');
		echo $this->Form->input('page');
		echo $this->Form->input('filename',array('label'=>'Choose a file','type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

</div>