<?php

/*
*autoload class function
*/
   // session_start();

spl_autoload_register(function($classname){

	include "classes/" . $classname . ".class.php";

});
/*
*database details
*/

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "oop_db");