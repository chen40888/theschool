<?php
class Spreadsheet_Handler {

	public static function get_first_spreadsheet_as_array($excel_path, $mime_type) {
		include_once conf('path.excel_reader');
		include_once conf('path.spreadsheet_reader_class');

		$spreadsheet = new SpreadsheetReader($excel_path, false, $mime_type);

		// Default spreadsheet to return is the first one at index 0
		$first_spreadsheet_array = array();
		foreach($spreadsheet as $key => $row) {
			$first_spreadsheet_array[] = $row;
		}

		return $first_spreadsheet_array;
	}

}
