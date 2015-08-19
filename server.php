<?php

if (isset($_POST['action'])) {
	$action = $_POST['action'];
	
	switch ($action) {
		case 'login':
			login();
			break;
		case 'getitem':
			getitem();
			break;
		case 'getsalesbyid':
			getsalesbyid();
			break;
	    default:
	    	echo 'unknown request';
	}
}

function login() {
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if ($username == '' || $password == '') {
			echo 'missing username/password combination';
			return;
		}
	} else {
		echo 'missing username/password combination';
		return;
	}
	
	$link = mysql_connect("localhost", "root", "");
	$result = mysql_db_query("scm", "select * from login",$link);
	$check = 0;
	while ($login = mysql_fetch_row($result)) {
		if($login[0]== $username and $login[1]==$password) {
			$check = 1;
		}
	}
	echo $check;
}

function getitem() {
	if (isset($_POST['id'])) {
		$itemid = $_POST['id'];
	} else {
		echo json_encode(array());
		return;
	}
	
	$link = mysql_connect("localhost", "root", "");
	$result = mysql_db_query("scm", "select * from item where itemid=$itemid",$link);
	$item = mysql_fetch_assoc($result);
	echo json_encode($item);
}

function getsalesbyid() {
	if (isset($_POST['id'])) {
		$orderid = $_POST['id'];
	} else {
		echo json_encode(array());
		return;
	}
	
	$link = mysql_connect("localhost", "root", "");
	$result = mysql_db_query("scm", "select * from sales where orderid=$orderid",$link);
	$item = mysql_fetch_assoc($result);
	echo json_encode($item);
	
}

?>