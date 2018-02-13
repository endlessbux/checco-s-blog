<?php
	session_start();
	if(!isset($_SESSION['user']['role']) || $_SESSION['user']['role']<2){
		header('Location: /login.php');
		die();
	}
	define('DOC_TITLE', 'Home | Checco');
	require('util/utils.php');
	echo start('Pannello di Controllo | Checco');

	echo fin();
?>
