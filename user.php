<?php
class User {
	private $mysqli;
	public $id;
	public $username;
	public $name;

	function __construct() {
		global $mysqli, $_SESSION;
		if ($_SESSION['id']) {
			$id = $_SESSION['id'];
			$my = $mysqli->query("SELECT * FROM users WHERE id=" . $id);
			if ($my->num_rows > 0) {
				$my = $my->fetch_object();
				$this->id = $my->id;
				$this->username = $my->username;
				$this->name = $my->name;
			}
		} else {
			$this->id = 0;
			$this->username = null;
			$this->name = "Госць";
		}
	}
}
$my = new User();