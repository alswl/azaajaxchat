<div class="messages form">
<?php echo $this->Form->create('Message');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Message', true)); ?></legend>
	<?php
		echo $this->Form->input('message_from');
		echo $this->Form->input('content');
		echo $this->Form->input('message_to');
		echo $this->Form->input('send_time');
		echo $this->Form->input('is_boardcast');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Messages', true)), array('action' => 'index'));?></li>
	</ul>
</div>