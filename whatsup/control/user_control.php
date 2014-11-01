<?php
require("../../model/user_model.php");

function register($userName,$userPassword,$Email,$name,$sex,$birthday,$phone,$address,$zip)
{
	$userxml = new USERXML();
	$user = new USER();
	$user->setUserName($userName);
	$user->setUserPassword($userPassword);
	$user->setEmail($Email);
	$user->setDetail($name, $sex, $birthday, $phone, $address, $zip);
	return $userxml->insertUser($user);
}

function login($userName,$userPassword)
{
	if(!$userName)
	{
		return false;
	}
	$userxml = new USERXML();
	$user = new USER();
	$user = $userxml->getUserByUserName($userName);
	if(!$user)
	{
		return false;
	}
	if($userPassword != $user->getUserPassword())
		return false;
	else 
	{
		return true;
	}
}
?> 