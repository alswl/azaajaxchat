<?php echo $content_for_layout ?>
<?php if (Configure::read('DEBUG') != '0') {
		echo $this->element('sql_dump');} ?>