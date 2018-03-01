<?php

class Validation {

	public static function valid ($input_1 = 'defult', $input_2 = 'defult', $input_3 = 'defult',$input_4 = 'defult',$input_5 = 'defult', $input_6 = 'defult', $input_7 = 'defult', $input_8 = 'defult') {
		if($input_1 == '' || $input_2 == '' || $input_3 == '' || $input_4 == '' || $input_5 == '' || $input_6 == '' || $input_7 == '' || $input_8 == '') return FALSE;
		return TRUE;
	}
}
