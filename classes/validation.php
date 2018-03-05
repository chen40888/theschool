<?php

class Validation {

	public static function valid ($arr = array()){
			foreach($arr as $value) {
				if(empty($value)) throw new Custom_Exception(Validation_Exception::$empty_input);
			}
		return TRUE;
		}
}
