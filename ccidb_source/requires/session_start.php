<?php

if(!isset($_SESSION)) {
	ini_set('session.gc_maxlifetime', 2592000);
    session_set_cookie_params(2592000);
	session_start();
}

?>