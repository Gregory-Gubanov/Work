<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$idElem = $_GET['id'];
$idBlock = $_GET['iblock_id'];
$addBlock = $_GET['add_block'];
CModule::IncludeModule('iblock');

if($addBlock != false){
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_ID_REVIEW", "PROPERTY_CODE_PRODUCT");
	$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID_ANSWER'], "ACTIVE"=>"Y", "PROPERTY_ID_REVIEW"=>$idElem);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		
		if(CIBlock::GetPermission($addBlock)>='W')
		{
			$DB->StartTransaction();
			if(!CIBlockElement::Delete($arFields['ID']))
			{
				$strWarning .= 'Error!';
				$DB->Rollback();
			}
			else
				$DB->Commit();
		}
	}
}

if(CIBlock::GetPermission($idBlock)>='W')
{
	$DB->StartTransaction();
	if(!CIBlockElement::Delete($idElem))
	{
		$strWarning .= 'Error!';
		$DB->Rollback();
	}
	else
		$DB->Commit();
}
?>