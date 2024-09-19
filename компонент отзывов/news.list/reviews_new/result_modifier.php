<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!$arParams["TEMPLATE_VIEW"]) {
	if ($arParams["VIEW_TYPE"]) {
		$arParams["TEMPLATE_VIEW"] = $arParams["VIEW_TYPE"];
	}
	else {
		$arParams["TEMPLATE_VIEW"] = 'grid';
	}
}

$aspectRatio = 3/2;

if (isset($arParams['IMAGE_ASPECT_RATIO'])) {
	$iar = explode("by", $arParams['IMAGE_ASPECT_RATIO']);
	if (is_numeric($iar[0]) && is_numeric($iar[1])) {
		$aspectRatio = $iar[0] / $iar[1];
	}
}

//if ($arParams['TEMPLATE_VIEW'] == 'list') {
//	$resizeWidth = 300;
//}
//else {
//	$resizeWidth = 320;
//}


if($arParams['RESIZE_WIDTH']) {
	$resizeWidth = $arParams['RESIZE_WIDTH']; 
}


$resizeHeight = $resizeWidth / $aspectRatio;

$resizeType = BX_RESIZE_IMAGE_EXACT;

if($arParams['RESIZE_TYPE'] == "contain") {
	$resizeType = BX_RESIZE_IMAGE_PROPORTIONAL;
}
elseif($arParams['RESIZE_TYPE'] == "cover") {
	$resizeType = BX_RESIZE_IMAGE_EXACT;
}


foreach($arResult["ITEMS"] as $arKey => $arItem) {
	if($arItem['PREVIEW_PICTURE']) {
		$resizedPicture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array("width" => $resizeWidth, "height" => $resizeHeight), $resizeType, true);
		$arResult["ITEMS"][$arKey]['PREVIEW_PICTURE']['RESIZED'] = array_change_key_case($resizedPicture, CASE_UPPER);
	}
	elseif($arItem['DETAIL_PICTURE']) {
		$resizedPicture = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array("width" => $resizeWidth, "height" => $resizeHeight), $resizeType, true);
		$arResult["ITEMS"][$arKey]['DETAIL_PICTURE']['RESIZED'] = array_change_key_case($resizedPicture, CASE_UPPER);
	}
}
