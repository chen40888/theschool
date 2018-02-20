<?php

class School_Table {

	public static function get_all_with_table_name($table_name) {
		$query = "SELECT * FROM $table_name";
		return DB::fetch_all($query);

	}










	public static function get_all_with_exam_name() {
		$sql = "SELECT q.*, e.name AS exam_name 
		FROM exam_question q
		INNER JOIN exam AS e ON q.exam_id = e.id
		ORDER BY id";
		return DB::fetch_all($sql);
	}

	public static function get_one_with_exam_name($question_id) {
		$sql = "SELECT q.*, e.name AS exam_name 
		FROM exam_question q
		INNER JOIN exam AS e ON q.exam_id = e.id
		WHERE q.id = {$question_id}";
		return DB::fetch_row($sql);
	}

	public static function insert_new_question($row_array) {
		if ($row_array['exam_id'] == null) {
			$row_array['exam_id'] = Exam_Table::get_first_exam_id();
		}
		$sql = "INSERT INTO exam_question 
				(question, correct_option_id, score, exam_id) 
				VALUES (?, ?, ?, ?)";
		DB::execute('INSERT', $sql, $row_array);
	}

	public static function get_question($question_id, $relativity = 'current') {
		$rel_sign = '=';
		$order_direction = '';

		switch($relativity) {
			case 'first': 	$question_id = self::get_first_question_id(); 	break;
			case 'prev': $rel_sign = '<'; $order_direction = 'DESC '; break;
			case 'next': $rel_sign = '>'; break;
			case 'last': $question_id = self::get_last_question_id(); break;
		}
		$sql = "SELECT * FROM exam_question WHERE id {$rel_sign} {$question_id} ORDER BY id {$order_direction}LIMIT 1";
		return DB::fetch_row($sql);
	}

	public static function get_exam_question_id($exam_id, $question_id, $relativity = 'current') {
		$rel_sign = '=';
		$order_direction = '';

		switch($relativity) {
			case 'first': return self::get_first_question_id(); break;
			case 'prev':  $rel_sign = '<'; $order_direction = 'DESC '; break;
			case 'next':  $rel_sign = '>'; break;
			case 'last':  return self::get_last_question_id(); break;
		}
		$sql = "SELECT q.id FROM exam_question AS q WHERE q.exam_id = '{$exam_id}' AND q.id {$rel_sign} {$question_id} ORDER BY q.id {$order_direction}LIMIT 1";
		//Log::w('#### Get ' .$relativity . ' question id SQL:' . $sql);
		return DB::fetch_value($sql);
	}

	public static function delete_question($question_id) {
		$sql = "DELETE FROM exam_question WHERE id='$question_id'; ";
		DB::execute('DELETE', $sql);
	}

	public static function get_all_questions() {
		$sql = "SELECT * FROM exam_question";
		$reply = DB::fetch_all($sql);
		return $reply;
	}

	public static function get_all_questions_of_exam($exam_id) {
		$sql = "SELECT e.* FROM exam_question e WHERE e.exam_id = '{$exam_id}' ORDER BY e.id";
		return DB::fetch_all($sql);
	}

	public static function get_all_question_ids_of_exam($exam_id) {
		$sql = "SELECT e.id FROM exam_question e WHERE e.exam_id = '{$exam_id}' ORDER BY e.id";
		return DB::fetch_list($sql);
	}

	public static function get_first_question_id_of_exam($exam_id) {
		$sql = "SELECT e.id FROM exam_question e WHERE e.exam_id = '{$exam_id}' ORDER BY e.id LIMIT 1";
		return DB::fetch_value($sql);
	}

	public static function get_one_question_of_exam($exam_id, $question_id) {
		$sql = "SELECT e.* FROM exam_question e WHERE e.exam_id = '{$exam_id}' AND e.id = '{$question_id}'";
		return DB::fetch_row($sql);
	}

	public static function get_first_question_id() {
		$sql = "SELECT e.id FROM exam_question e ORDER BY e.id LIMIT 1";
		return DB::fetch_value($sql);
	}

	public static function get_last_question_id() {
		$sql = "SELECT e.id FROM exam_question e ORDER BY e.id DESC LIMIT 1";
		return DB::fetch_value($sql);
	}

	public static function get_total() {
		$sql = "SELECT count(e.id) AS total FROM exam_question AS e";
		return (int) DB::fetch_value($sql);
	}

	public static function get_total_questions_count_for_exam($exam_id) {
		$sql = "SELECT count(e.id) AS total FROM exam_question AS e WHERE e.exam_id = {$exam_id}";
		return (int) DB::fetch_value($sql);
	}

	public static function update_correct_option_id($question_id, $correct_option_id) {
		$sql = 	"UPDATE exam_question SET correct_option_id = '{$correct_option_id}' WHERE id = {$question_id} LIMIT 1";
		DB::execute('UPDATE', $sql);
	}

	public static function get_next_unanswered_question($exam_id, $session_id, $curr_question_id = 0) {
		$sql = "SELECT e.id
		FROM exam_question e
		WHERE e.exam_id = '{$exam_id}'
		AND e.id NOT IN (SELECT er.question_id FROM exam_results AS er WHERE er.is_correct_option = '1' AND er.session_id = '{$session_id}')
		AND e.id > '{$curr_question_id}'
		ORDER BY e.id
		LIMIT 1";

		$next_unanswered_question = DB::fetch_value($sql);
		//Log::w('$exam_id: ' . $exam_id . ' | $session_id: ' . $session_id . ' | $next_unanswered_question: ' . $next_unanswered_question);
		return $next_unanswered_question;
	}

	public static function get_correct_option_of_question($question_id) {
		$sql = "SELECT e.correct_option_id FROM exam_question AS e WHERE e.id = {$question_id}";
		return DB::fetch_value($sql);
	}

	public static function get_score($question_id) {
		$sql = "SELECT e.score FROM exam_question AS e 
		WHERE id = {$question_id}
		LIMIT 1";
		return DB::fetch_value($sql);
	}
}
