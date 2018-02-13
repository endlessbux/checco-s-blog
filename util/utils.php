<?php
require(dirname(__FILE__).'/call-ext.php');
require(dirname(__FILE__).'/call-src.php');
require(dirname(__FILE__).'/head-tags.php');

function start($title, $spec){
	define('SRC_SPEC',$spec);
	if(isset($spec)){
		require(dirname(__FILE__).'/specs/'.$spec);
		$css	=	'';
		if(SRC_SPEC !== null){
			$css	=	specCss();
		}
	}
	return '<!DOCTYPE html>
			<html>
				<head>'.
					extCss().
					srcCss().
					$css.
					headTags($title).
				'</head>
				<body>';
}

function fin(){
	$js	=	'';
	if(SRC_SPEC !== null){
		$js	=	specJs();
	}
	return 		extJs().
				srcJs().
				$js.
				'</body>
			</html>';
}

function db_connection(){
	require(dirname(__FILE__).'/db/connect.php');
	if(!$mysqli){
		echo '<div class="alert alert-warning text-center"><strong>Errore interno</strong>, impossibile stabilire una connessione con il database</div>';
		echo fin();
		die();
	}
	return $mysqli;
}
?>
