Задача состояла в том что бы Яндекс доставка правильно рассчитывала тарифы исходя из габаритов товаров, для этого были написаны 2 обработчика, первый обработчик написан для получения веса из свойства товара, мы получаем вес и переводим его в граммы и подставляем в карточку товара, в торговый каталог http://joxi.ru/52aWZBjs063Rxr. И так же получали длину, ширину и высоту из свойства с типом строка, брали данные из свойства http://joxi.ru/82QJNLnT4PvJ4A разбивали его и помещали в торговый каталог http://joxi.ru/Drlx9BYtdMOqjr

<?
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;

$eventManager = EventManager::getInstance();
$eventManager->addEventHandler(
    'catalog',
    'Bitrix\Catalog\Model\Product::OnBeforeUpdate',
    static function ($event) {
        $id = $event->getParameter("id");

        // Инфоблок с ID 1
        $iblockId = 1;

        // Получаем подключение к базе данных
        $connection = Application::getConnection();

        // Выполняем запрос к базе данных для получения значения свойства веса
        $sql = "SELECT `VALUE` FROM `b_iblock_element_property` WHERE `IBLOCK_ELEMENT_ID` = " . $id . " AND `IBLOCK_PROPERTY_ID` = 2095";
        $record = $connection->query($sql)->fetch();

        // Если запись найдена
        if ($record) {
            // Получаем значение свойства веса
            $weightInKg = floatval($record['VALUE']);

            // Переводим вес из килограммов в граммы
            $weightInGrams = $weightInKg * 1000;

            // Обновляем поле WEIGHT товара в граммах
            $result = new \Bitrix\Main\ORM\EventResult;
            $result->modifyFields(['fields' => ['WEIGHT' => $weightInGrams]]);
            return $result;
        }
    }
);

$eventManager = EventManager::getInstance();
$eventManager->addEventHandler(
    'catalog',
    'Bitrix\Catalog\Model\Product::OnBeforeUpdate',
    static function ($event) {
        $id = $event->getParameter("id");

        // Инфоблок с ID 1
        $iblockId = 1;

        // Получаем подключение к базе данных
        $connection = Application::getConnection();

        // Выполняем запрос к базе данных для получения значения свойства
        $sql = "SELECT `VALUE` FROM `b_iblock_element_property` WHERE `IBLOCK_ELEMENT_ID` = " . $id . " AND `IBLOCK_PROPERTY_ID` = 1008";
        $record = $connection->query($sql)->fetch();

        // Инициализируем переменные для ширины, длины и высоты
        $width = $length = $height = 0;

        // Если запись найдена
        if ($record) {
            // Получаем значение свойства
            $value = $record['VALUE'];

            // Ищем числа в строке с помощью регулярного выражения
            preg_match_all('/(\d+(\.\d+)?)/', $value, $matches);

            // Если найдены числа
            if (!empty($matches[0])) {
                // Первое значение - длина, второе - ширина, третье - высота
                $length = floatval(str_replace(',', '.', $matches[0][0])) * 10; // Переводим длину из см в мм
                $width = floatval(str_replace(',', '.', $matches[0][1])) * 10; // Переводим ширину из см в мм
                $height = floatval(str_replace(',', '.', $matches[0][2])) * 10; // Переводим высоту из см в мм
            }
        }

        // Обновляем поля товара с размерами
        $result = new \Bitrix\Main\ORM\EventResult;
        $result->modifyFields(['fields' => [
            'LENGTH' => $length,
            'WIDTH' => $width,
            'HEIGHT' => $height
        ]]);
        return $result;
    }
);
?>

Разрабатывал многосайтовость для сайтов https://umka-npr.ru/ и https://kroha-market.ru/


функция для получения данных из заказа в почтовое событие 

<?
//-- Добавление обработчика события
AddEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");
//-- Собственно обработчик события
function bxModifySaleMails($orderID, &$eventName, &$arFields)
{
    $arOrder = CSaleOrder::GetByID($orderID);
    //-- получаем телефоны и адрес
    $order_props = CSaleOrderPropsValue::GetOrderProps($orderID);
    $phone="";
    $index = "";
    $country_name = "";
    $city_name = "";
    $address = "";
    $fio = "";
    while ($arProps = $order_props->Fetch())
    {
    if ($arProps["CODE"] == "PHONE")
    {
    $phone = htmlspecialchars($arProps["VALUE"]);
    }
    if ($arProps["CODE"] == "FIO")
    {
    $fio = htmlspecialchars($arProps["VALUE"]);
    }
    if ($arProps["CODE"] == "EMAIL")
    {
    $email = htmlspecialchars($arProps["VALUE"]);
    }
    if ($arProps["CODE"] == "INDEX")
    {
    $index = $arProps["VALUE"];
    }
    if ($arProps["CODE"] == "ADDRESS")
    {
    $address = $arProps["VALUE"];
    }
    }
    $full_address = $address;
    //-- получаем название службы доставки
    $arDeliv = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);
    $delivery_name = "";
    if ($arDeliv)
    {
    $delivery_name = $arDeliv["NAME"];
    }
    //-- получаем название платежной системы
    $arPaySystem = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"]);
    $pay_system_name = "";
    if ($arPaySystem)
    {
    $pay_system_name = $arPaySystem["NAME"];
    }
    //-- добавляем новые поля в массив результатов
    $arFields["ORDER_DESCRIPTION"] = $arOrder["USER_DESCRIPTION"];
    $arFields["PHONE"] =  $phone;
    $arFields["DELIVERY_NAME"] =  $delivery_name;
    $arFields["PAY_SYSTEM_NAME"] =  $pay_system_name;
    $arFields["FULL_ADDRESS"] = $full_address;
    $arFields["FIO"] = $fio;
}
?>


Задача сделать регистрацию для юр лиц просто сделаны табы и подкидывается свой шаблон регистрации к каждому типу пользователя http://joxi.ru/eAO8NW3cGyjXQr 

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>

<?if($USER->IsAuthorized()):?>
    <?LocalRedirect("/auth/");?>
<?else:?>

<div class="auth-cstm">
    <div class="module-form-block-wr registraion-page">
        <div class="form-block border_block pad">
            <div class="top">
                <?$APPLICATION->IncludeFile(SITE_DIR."include/register_description.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("REGISTER_INCLUDE_AREA"), ));?>
            </div>

            <div class="user-types">
                <div class="user-types__label">Выберите тип пользователя</div>
                <div class="user-types__wrap">
                    <a class="user-types__option btn btn-default" href="/auth/registration/">Физ. лицо</a>
                    <a class="user-types__option btn btn-default active nopoint">Юр. лицо</a>
                </div>
            </div>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent(
    "bitrix:main.register", 
    "main_yur", 
    array(
        "AUTH" => "Y",
        "REQUIRED_FIELDS" => array(
            0 => "EMAIL",
            1 => "NAME",
            2 => "PERSONAL_PHONE",
        ),
        "SET_TITLE" => "N",
        "SHOW_FIELDS" => array(
            0 => "NAME",
            1 => "WORK_COMPANY",
            2 => "EMAIL",
            3 => "PERSONAL_PHONE",
        ),
        "SUCCESS_PAGE" => "",
        "USER_PROPERTY" => array(
            0 => "UF_TYPE_USER",
            1 => "UF_INN",
            2 => "UF_KPP",
        ),
        "USER_PROPERTY_NAME" => "",
        "USE_BACKURL" => "Y",
        "COMPONENT_TEMPLATE" => "main_yur"
    ),
    false
);?>

</div>

<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>

<?if($USER->IsAuthorized()):?>
    <?LocalRedirect("/auth/");?>
<?else:?>

<div class="auth-cstm">
    <div class="module-form-block-wr registraion-page">
        <div class="form-block border_block pad">
            <div class="top">
                <?$APPLICATION->IncludeFile(SITE_DIR."include/register_description.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("REGISTER_INCLUDE_AREA"), ));?>
            </div>

            <div class="user-types">
                <div class="user-types__label">Выберите тип пользователя</div>
                <div class="user-types__wrap">
                    <a class="user-types__option btn btn-default" href="/auth/registration/">Физ. лицо</a>
                    <a class="user-types__option btn btn-default active nopoint">Юр. лицо</a>
                </div>
            </div>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent(
    "bitrix:main.register", 
    "main_yur", 
    array(
        "AUTH" => "Y",
        "REQUIRED_FIELDS" => array(
            0 => "EMAIL",
            1 => "NAME",
            2 => "PERSONAL_PHONE",
        ),
        "SET_TITLE" => "N",
        "SHOW_FIELDS" => array(
            0 => "NAME",
            1 => "WORK_COMPANY",
            2 => "EMAIL",
            3 => "PERSONAL_PHONE",
        ),
        "SUCCESS_PAGE" => "",
        "USER_PROPERTY" => array(
            0 => "UF_TYPE_USER",
            1 => "UF_INN",
            2 => "UF_KPP",
        ),
        "USER_PROPERTY_NAME" => "",
        "USE_BACKURL" => "Y",
        "COMPONENT_TEMPLATE" => "main_yur"
    ),
    false
);?>

</div>

<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>


Обработчик получения группы пользователя
<?
$eventManager =  \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("main", "OnAfterUserRegister", "UserGroup");

function UserGroup($arFields)
{
    if($arFields["UF_TYPE_USER"] == "Y"){
        CUser::SetUserGroup($arFields["USER_ID"], array(11));
    }else{
        CUser::SetUserGroup($arFields["USER_ID"], array(6));
        $user = new CUser;
        $fields = Array(
            "UF_TYPE_USER"  => "N"
        );
        $user->Update($arFields["USER_ID"], $fields);
    }
}
?>


Разработка компонента отзывов для сайта https://eterial.com http://joxi.ru/J2bdaBpcM8OK9r http://joxi.ru/bmoy9JPHl6vPKA результат попадает в инфоблок и проставляется по среднему арифметическому высчитывается значение и подставляется в карточку товара http://joxi.ru/Grq89GPcb1dv3A и в списке http://joxi.ru/zAN7j6Rfwbz3Dr 




