<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$idElem = $_GET['id'];

CModule::IncludeModule('iblock');

CIBlockElement::SetPropertyValueCode($idElem, 'RATING', array('VALUE' => $_GET['edit-rating']));
CIBlockElement::SetPropertyValueCode($idElem, 'ADVANTAGE', array(array("TYPE"=>"TEXT", "TEXT"=>$_GET['advantage'])));
CIBlockElement::SetPropertyValueCode($idElem, 'DISADVANTAGE', array(array("TYPE"=>"TEXT", "TEXT"=>$_GET['disadvantage'])));
CIBlockElement::SetPropertyValueCode($idElem, 'COMMENTS', array(array("TYPE"=>"TEXT", "TEXT"=>$_GET['comment'])));
?>