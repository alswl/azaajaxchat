<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php printf(__('Admin Add %s', true), __('User', true)); ?></legend>
	<?php
		echo $this->Form->input('login_name');
		echo $this->Form->input('user_password');
		echo $this->Form->input('user_group');
		echo $this->Form->input('real_name');
		echo $this->Form->input('register_time');
		echo $this->Form->input('last_login_ip');
		echo $this->Form->input('last_login_time');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Users', true)), array('action' => 'index'));?></li>
	</ul>
</div>