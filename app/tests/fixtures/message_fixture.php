<?php
/* Message Fixture generated on: 2010-05-16 14:05:10 : 1274018950 */
class MessageFixture extends CakeTestFixture {
	var $name = 'Message';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'channel_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'is_boardcast' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'message_from' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'message_to' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'message_time' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'content' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10240),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'channel_id' => 1,
			'is_boardcast' => 1,
			'message_from' => 1,
			'message_to' => 1,
			'message_time' => '2010-05-16 14:09:10',
			'content' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>