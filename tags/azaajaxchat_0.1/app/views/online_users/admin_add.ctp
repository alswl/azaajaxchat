<div class="onlineUsers form">
<?php echo $this->Form->create('OnlineUser');?>
	<fieldset>
 		<legend><?php printf(__('Admin Add %s', true), __('Online User', true)); ?></legend>
	<?php
		echo $this->Form->input('user_login_name');
		echo $this->Form->input('user_group');
		echo $this->Form->input('channel_id');
		echo $this->Form->input('last_login_time');
		echo $this->Form->input('last_login_ip');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Online Users', true)), array('action' => 'index'));?></li>
	</ul>
</div>