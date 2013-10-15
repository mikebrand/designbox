<div class="pages index">
<div class="projects index">
	<h2><?php __('Pages');?></h2>
	<table cellpadding="0" cellspacing="0">
	
	<?php
	//print_r($pages);
	$i = 0;
	foreach ($pages as $page_holder):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $page_holder['Page']['id']; ?>&nbsp;</td>
		<td><?php echo $page_holder['Page']['created']; ?>&nbsp;</td>
		<td><?php echo $page_holder['Page']['updated']; ?>&nbsp;</td>
		<td><?php echo $page_holder['Project']['name'] ?>&nbsp;</td>
		<td><?php echo $page_holder['Page']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $page_holder['Page']['id']));?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $page_holder['Page']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $page_holder['Page']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $page_holder['Page']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Page', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>