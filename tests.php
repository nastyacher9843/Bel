<?php

class Question {
	public $text;
	public $order;
	public $id;
	public $answers;
	function __construct($question) {
		global $mysqli;
		$this->answers = [];
		$this->id = $question->id;
		$result = $mysqli->query("SELECT * FROM answers WHERE question_id=" . $question->id);
		while ($answer = $result->fetch_object()) {
			$this->answers[$answer->id] = $answer;
		}
		$this->text = $question->text;
		$this->order = $question->order;
	}
}

class Test {
	public $id;
	public $name;
	public $questions;
	function __construct($test) {
		global $mysqli;
		$this->questions = [];
		$result = $mysqli->query("SELECT * FROM questions WHERE test_id=" . $test->id);
		while ($question = $result->fetch_object()) {
			$this->questions[$question->id] = new Question($question);
		}
		$this->name = $test->name;
		$this->id = $test->id;
	}
}

class Tests {
	public $tests;
	function __construct() {
		global $mysqli;
		$result = $mysqli->query("SELECT * FROM tests");
		$this->tests = [];
		while ($test = $result->fetch_object()) {
			$this->tests[$test->id] = new Test($test);
		}
	}
}

$tests = new Tests();
$tests = $tests->tests;
