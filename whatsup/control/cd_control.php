<?php
require("../../model/cd_model.php");

function insertCD($cd)
{
	$cdXml = new CDXML();
	$cdXml->insertCD($cd);
}

function getCDByName($name)
{
	$cdXml = new CDXML();
	return $cdXml->getCDByName($name);
}

function getCDByID($ID)
{
	$cdXml = new CDXML();
	return $cdXml->getCDByID($ID);
}

function modifyCD($cd)
{
	$cdXml = new CDXML();
	$cdXml->modifyCD($cd);
}

function deleteCDByID($ID)
{
	$cdXml = new CDXML();
	return $cdXml->deleteCDByID($ID);
}

function showAllCD()
{
	$cdXml = new CDXML();
	return $cdXml->showAllCD();
}

function getCDByLanguage($language)
{
	$cdXML = new CDXML();
	return $cdXML->getCDByLanguage($language);
}

function getCDByArea($area)
{
	$cdXML = new CDXML();
	return $cdXML->getCDByArea($area);
}