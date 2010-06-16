<div class="onlineUsers index">
	<h2><?php __('Online Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('user_login_name');?></th>
			<th><?php echo $this->Paginator->sort('user_group');?></th>
			<th><?php echo $this->Paginator->sort('channel_id');?></th>
			<th><?php echo $this->Paginator->sort('last_login_time');?></th>
			<th><?php echo $this->Paginator->sort('last_login_ip');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($onlineUsers as $onlineUser):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $onlineUser['OnlineUser']['user_id']; ?>&nbsp;</td>
		<td><?php echo $onlineUser['OnlineUser']['user_login_name']; ?>&nbsp;</td>
		<td><?php echo $onlineUser['OnlineUser']['user_group']; ?>&nbsp;</td>
		<td><?php echo $onlineUser['OnlineUser']['channel_id']; ?>&nbsp;</td>
		<td><?php echo $onlineUser['OnlineUser']['last_login_time']; ?>&nbsp;</td>
		<td><?php echo $onlineUser['OnlineUser']['last_login_ip']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $onlineUser['OnlineUser']['user_id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $onlineUser['OnlineUser']['user_id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $onlineUser['OnlineUser']['user_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $onlineUser['OnlineUser']['user_id'])); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Online User', true)), array('action' => 'add')); ?></li>
	</ul>
</div>