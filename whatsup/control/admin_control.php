<?php
require '../../model/admin_model.php';
function getAdminByAdminName($adminName)
{
	$adminXML = new AdminXML();
	return $adminXML->getAdminByAdminName($adminName);
}

function insertAdmin($admin)
{
	$adminXML = new AdminXML();
	return $adminXML->insertAdmin($admin);
}

function modifyAdmin($newAdmin)
{
	$adminXML = new AdminXML();
	$adminXML->modifyAdmin($newAdmin);
}

function deleteAdminByAdminName($name)
{
	$adminXml = new AdminXML();
	$adminXml->deleteAdminByAdminName($name);
}

function uploadCD($cdArray,$songArray)
{
	$adminXML = new AdminXML();
	$adminXML->uploadCD($cdArray,$songArray);
}

function modify_CD($cdArray,$songArray)
{
	$adminXML = new AdminXML();
	$adminXML->modify_CD($cdArray, $songArray);
}

function login($adminName,$adminPassword)
{
	if(!$adminName)
	{
		return false;
	}
	$admin = getAdminByAdminName($adminName);
	
	if(!$admin)
	{
		return false;
	}
	
	if($adminPassword != $admin->getAdminPassword())
	{
		return false;
	}
	
	else
	{
		return true;
	}
}

