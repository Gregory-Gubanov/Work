<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("DISPLAY_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_DETAIL_BUTTON" => Array(
		"NAME" => GetMessage("DISPLAY_DETAIL_BUTTON"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
);

$arTemplateParameters['TEMPLATE_VIEW'] = array(
	'PARENT' => 'BASE',
	'NAME' => GetMessage('TEMPLATE_VIEW'),
	'TYPE' => 'LIST',
	'MULTIPLE' => 'N',
	'ADDITIONAL_VALUES' => 'N',
	'REFRESH' => 'Y',
	'DEFAULT' => 'N',
	'VALUES' => array(
		"grid" => GetMessage('TEMPLATE_VIEW_GRID'),
		"list" => GetMessage('TEMPLATE_VIEW_LIST'),
		"slider" => GetMessage('TEMPLATE_VIEW_SLIDER')
	)
);

if ($arCurrentValues["TEMPLATE_VIEW"] == "grid" || $arCurrentValues["TEMPLATE_VIEW"] == "slider")
{
	$arTemplateParameters["ITEMS_COLS_XXS"] = array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("ITEMS_COLS") . ' 320px',
		"VALUES" => array(
			// "0" => GetMessage("ITEMS_COLS_INHERIT"),
			"1" => "1",
			"2" => "2",
			"3" => "3",
			// "4" => "4",
			// "5" => "5",
			// "6" => "6",
			// "6" => "6",
			// "7" => "7",
			// "7" => "7",
			// "8" => "8",
			// "8" => "8",
			// "9" => "9",
			// "9" => "9",
			// "10" => "10",
		),
		"TYPE" => "LIST",
		"VALUE" => "2",
		"DEFAULT" => "2",
	);
	$arTemplateParameters["ITEMS_COLS_XS"] = array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("ITEMS_COLS") . ' 480px',
		"VALUES" => array(
			// "0" => GetMessage("ITEMS_COLS_INHERIT"),
			"1" => "1",
			"2" => "2",
			"3" => "3",
			"4" => "4",
			// "5" => "5",
			// "6" => "6",
			// "7" => "7",
			// "8" => "8",
			// "9" => "9",
			// "10" => "10",
		),
		"TYPE" => "LIST",
		"VALUE" => "2",
		"DEFAULT" => "2",
	);
	$arTemplateParameters["ITEMS_COLS_SM"] = array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("ITEMS_COLS") . ' 768px',
		"VALUES" => array(
			// "0" => GetMessage("ITEMS_COLS_INHERIT"),
			"1" => "1",
			"2" => "2",
			"3" => "3",
			"4" => "4",
			"5" => "5",
			// "6" => "6",
			// "7" => "7",
			// "8" => "8",
			// "9" => "9",
			// "10" => "10",
		),
		"TYPE" => "LIST",
		"VALUE" => "2",
		"DEFAULT" => "2",
	);
	$arTemplateParameters["ITEMS_COLS_MD"] = array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("ITEMS_COLS") . ' 992px',
		"VALUES" => array(
			// "0" => GetMessage("ITEMS_COLS_INHERIT"),
			"1" => "1",
			"2" => "2",
			"3" => "3",
			"4" => "4",
			"5" => "5",
			"6" => "6",
			"7" => "7",
			"8" => "8",
			// "9" => "9",
			// "10" => "10",
		),
		"TYPE" => "LIST",
		"VALUE" => "2",
		"DEFAULT" => "2",
	);
	$arTemplateParameters["ITEMS_COLS_LG"] = array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("ITEMS_COLS") . ' 1200px',
		"VALUES" => array(
			// "0" => GetMessage("ITEMS_COLS_INHERIT"),
			"1" => "1",
			"2" => "2",
			"3" => "3",
			"4" => "4",
			"5" => "5",
			"6" => "6",
			"7" => "7",
			"8" => "8",
			"9" => "9",
			"10" => "10",
		),
		"TYPE" => "LIST",
		"VALUE" => "2",
		"DEFAULT" => "2",
	);
}


$arTemplateParameters["IMAGE_ASPECT_RATIO"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("IMAGE_ASPECT_RATIO"),
	"VALUES" => array(
		"2by1" => "2:1",
		"16by9" => "16:9",
		"3by2" => "3:2",
		"4by3" => "4:3",
		"5by4" => "5:4",
		"1by1" => GetMessage("IMAGE_ASPECT_RATIO_SQUARE"),
		"4by5" => "4:5",
		"3by4" => "3:4",
		"2by3" => "2:3",
		"9by16" => "9:16",
		"1by2" => "1:2",
	),
	"TYPE" => "LIST",
	"VALUE" => "3by2",
	"DEFAULT" => "3by2",
);


$arTemplateParameters["RESIZE_TYPE"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("RESIZE_TYPE"),
	"VALUES" => array(
		"contain" => GetMessage("BX_RESIZE_IMAGE_PROPORTIONAL"),
		"cover" => GetMessage("BX_RESIZE_IMAGE_EXACT"),
	),
	"TYPE" => "LIST",
	"VALUE" => "BX_RESIZE_IMAGE_PROPORTIONAL",
	"DEFAULT" => "BX_RESIZE_IMAGE_PROPORTIONAL",
);

if ($arCurrentValues['TEMPLATE_VIEW'] == 'list') {
	$resizeWidth = 300;
	// $resizeHeight = 200;
}
else {
	$resizeWidth = 319;
	// $resizeHeight = 213;
}

$arTemplateParameters["RESIZE_WIDTH"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("RESIZE_WIDTH"),
	"TYPE" => "STRING",
	"VALUE" => $resizeWidth,
	"DEFAULT" => $resizeWidth,
);

$arTemplateParameters["ADDITIONAL_CSS_CLASS"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("ADDITIONAL_CSS_CLASS"),
	"TYPE" => "STRING",
	"DEFAULT" => "",
);