<?php

require_once("db.php");
require_once("User.php");

$tp = new User(1);
$tp->set("pw", "'bragi'");



?>