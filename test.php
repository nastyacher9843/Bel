<?php 
include_once("header.php");
if ($my->id == 0) {
	header("Location: /login.php");
}

if ($request) {
	if (!$request->id) {
		header("Location: login.php");
	}

	if (!$tests[$request->id]) {
		header("Location: /");
	}

	$already_done = $mysqli->query("SELECT * FROM test_results WHERE user_id = " . $my->id . " AND test_id = " . $request->id);
	if ($already_done->num_rows > 0 ) {
		$template = "done_template";
		$test = $tests[$request->id];
	} else {

		if (!isset($request->question_id)) {
			$last_question = $mysqli->query("SELECT * FROM user_answers ua LEFT JOIN questions q ON q.id = ua.question_id LEFT JOIN tests t ON t.id = q.test_id WHERE ua.user_id = " . $my->id . " AND t.id = " . $request->id. " ORDER by ua.id DESC LIMIT 1");
			if ($last_question->num_rows > 0) {
				$last_question = $last_question->fetch_object();
				$question_num = $last_question->order;
			} else {
				$question_num = 0;
			}
			$question_id = $mysqli->query("SELECT id FROM questions WHERE test_id = " . $request->id . " AND `order` > " . $question_num . " ORDER by `order` LIMIT 1");
			$question_id = $question_id->fetch_object();
			$question_id = $question_id->id;
			header("Location: /test.php?id=" . $request->id . "&question_id=" . $question_id);
		} else {
			if ($request->form) {
				if (!$request->answer) {
					$message = "Не выбран ни один вариант ответа";
				} else {
					$correct = $mysqli->query("SELECT id FROM answers WHERE question_id=" . $request->question_id . " AND correct = 1");
					$correct_arr = [];
					while ($answer = $correct->fetch_object()) {
						$correct_arr[] = $answer->id;
					}
					$result = 1;
					foreach ($request->answer as $key=>$answer) {
						if (!in_array($key, $correct_arr)) {
							$result = 0;
						}
					}
					$mysqli->query("INSERT INTO user_answers (question_id, answer, user_id) VALUES (" . $request->question_id . "," . $result . "," . $my->id . ")");
					$max_id = $mysqli->query("SELECT id FROM questions WHERE test_id = " . $request->id . " AND `order` = (SELECT  max(`order`) FROM questions WHERE test_id = " . $request->id . ") ORDER by `order` LIMIT 1");
					$max_id = $max_id->fetch_object();
					$max_id = $max_id->id;
					if ($max_id != $request->question_id) {
						header("Location: /test.php?id=" . $request->id);
					} else {
						$questions = $mysqli->query("SELECT * from questions WHERE test_id = " . $request->id);
						$questions = $questions->num_rows;
						$correct_answers = $mysqli->query("SELECT * FROM user_answers ua LEFT JOIN questions q ON q.id = ua.question_id LEFT JOIN tests t ON t.id = q.test_id WHERE ua.answer=1 AND t.id = " . $request->id . " AND ua.user_id = " . $my->id);
						$correct_answers = $correct_answers->num_rows;
						$mysqli->query("INSERT INTO test_results (user_id, test_id, percent) VALUES (" . $my->id . "," . $request->id . ", " . round(($correct_answers / $questions) * 100) . ")");
						header("Location: /");
					}


				}
			} 
			$question = $tests[$request->id]->questions[$request->question_id];
			$template = "test_template";
		} 
	}
}

include_once($template . ".php");
include_once("footer.php");
?>