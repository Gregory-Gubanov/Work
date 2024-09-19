<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$idElem = $_GET['id'];
$idBlock = $_GET['iblock_id'];
$nameProp = $_GET['prop'];
$count = 0;

CModule::IncludeModule('iblock');

$arSelect = Array("ID", "NAME", "PROPERTY_LIKE", "PROPERTY_DISLIKE");
$arFilter = Array("IBLOCK_ID"=>$idBlock, "ID"=>$idElem);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();

 CIBlockElement::SetPropertyValueCode($idElem, $nameProp, array('VALUE' => $arFields['PROPERTY_'.$nameProp.'_VALUE']+1));
 $count = $arFields['PROPERTY_'.$nameProp.'_VALUE'] + 1;
}

echo  $count;
?>