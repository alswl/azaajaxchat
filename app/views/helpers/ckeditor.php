<?php

/*
 * Created on 2010-5-17
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class CkeditorHelper extends AppHelper {
	/**
	  * Other helpers used by CkeditorHelper
	  *
	  * @var array
	  * @access public
	  */
	var $helpers = array (
		'Html',
		'Form',
		'Javascript'
	);

	/**
	  * Holds the default options for ckeditor
	  *
	  * @var array
	  * @access public
	  */
	var $options = array (
		'width' => '100%',
		'height' => '500',
		'toolbarSet' => 'Default',
		'value' => '',
		'basePath' => '/js/ckeditor/'
	);

	/**
	  * Creates a ckeditor widget.
	  *
	  * @param string $fieldNamem Name of a field, like "Modelname.fieldname"
	  * @param array $options Array of HTML attributes.
	  * @return string An editor widget
	  */
	function widget($fieldName, $options = array ()) {
		$id = Inflector :: camelize(str_replace('.', '_', $fieldName));

		$code = "var ckeditor{$id} = new CKeditor('{$id}'); ";

		$code .= "ckeditor{$id}.Width = '{$this->options['width']}'; ";
		$code .= "ckeditor{$id}.Height = '{$this->options['height']}'; ";
		$code .= "ckeditor{$id}.ToolbarSet = '{$this->options['toolbarSet']}'; ";
		$code .= "ckeditor{$id}.Value = '{$this->options['value']}'; ";

		$code .= "ckeditor{$id}.BasePath = '" . $this->Html->webroot($this->options['basePath']) . "'; ";

		$code .= "ckeditor{$id}.ReplaceTextarea();";

		return $this->Form->textarea($fieldName, $options) . $this->Javascript->codeBlock($code);
	}
}
?>