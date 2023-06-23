<?php 
 include 'init.php';

 $ses = new Session();


 if ($ses->exists('USER')) {
 	$ses->remove('USER');
 }

        header("location: login.php");
		die;