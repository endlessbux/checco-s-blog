<?php
function extCss(){
	require('ext-path/css.php');
	return 	$bscss;
}
function extJs(){
	require('ext-path/js.php');
	return 	$fajs.
			$jquery.
			$popper.
			$bsjs;
}
?>
