<?php
require_once "code/code.class.php";
$code=new Code(260,70);
$code->outPut();
session_start();
$_SESSION['code']=$code->getcode();
