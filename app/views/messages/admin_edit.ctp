<div class="messages form">
<?php echo $this->Form->create('Message');?>
	<fieldset>
 		<legend><?php printf(__('Admin Edit %s', true), __('Message', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('channel_id');
		echo $this->Form->input('is_boardcast');
		echo $this->Form->input('message_from_id');
		echo $this->Form->input('message_from_login_name');
		echo $this->Form->input('message_to_id');
		echo $this->Form->input('message_to_login_name');
		echo $this->Form->input('action');
		echo $this->Form->input('message_time');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Message.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Message.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Messages', true)), array('action' => 'index'));?></li>
	</ul>
</div>