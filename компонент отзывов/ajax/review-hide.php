<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$idElem = $_GET['id'];
CModule::IncludeModule('iblock');

$obEl = new CIBlockElement();
$boolResult = $obEl->Update($idElem, array('ACTIVE' => 'N'));
?>