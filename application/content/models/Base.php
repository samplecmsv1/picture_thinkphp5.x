<?php
namespace app\content\models;
use app\content\models\core\tree as b;
class Base extends b{
	 public $get_lists_name = 'index';
	 public $get_form_name = 'index';
	 public $fields;
	 function __construct(){
	 	parent::__construct();
	 	$this->data = $_POST;
	 }
	 function get_fields(){
	 	return $this->fields;
	 }

	 function get_lists_name(){
	 	return $this->get_lists_name;
	 }

	 function get_form_name(){
	 	return $this->get_form_name;
	 }
	
	
}