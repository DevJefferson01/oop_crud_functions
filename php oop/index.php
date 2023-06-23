<?php  

include ('init.php');
include ('header.php');

if(!$strict = User::action()->restrict()) {
    header('location: login.php');
    die;
}

