<div class = "container small">
<div class="projects form">
<?php echo $this->Form->create('Image', array('type' => 'file','action'=>'../projects/add'));?>
	<fieldset>
		<div id = "imgContainer"><img src = "/img/addproject.png"></div>
	<?php
		echo "A project holds a collection of pages. For example, a project could be \"Portfolio website\" and then within it there could be pages for the index, the about page and more.<br /><br />";
		echo $this->Form->input('name');
		
		echo $this->Form->input('page');
		echo $this->Form->input('filename',array('label'=>'Choose a file','type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

</div>