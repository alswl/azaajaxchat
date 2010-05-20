<div class="messages index">
	<h2><?php __('Messages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('channel_id');?></th>
			<th><?php echo $this->Paginator->sort('is_boardcast');?></th>
			<th><?php echo $this->Paginator->sort('message_from_id');?></th>
			<th><?php echo $this->Paginator->sort('message_from_login_name');?></th>
			<th><?php echo $this->Paginator->sort('message_to_id');?></th>
			<th><?php echo $this->Paginator->sort('message_to_login_name');?></th>
			<th><?php echo $this->Paginator->sort('action');?></th>
			<th><?php echo $this->Paginator->sort('message_time');?></th>
			<th><?php echo $this->Paginator->sort('content');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($messages as $message):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $message['Message']['id']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['channel_id']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['is_boardcast']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['message_from_id']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['message_from_login_name']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['message_to_id']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['message_to_login_name']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['action']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['message_time']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['content']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $message['Message']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $message['Message']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $message['Message']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $message['Message']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Message', true)), array('action' => 'add')); ?></li>
	</ul>
</div>