<?php

# domen

function formatPhone($phone){return preg_replace('/[^0-9]/', '', $phone);}

$_POST["phone"] = formatPhone($_POST["phone"]);
    
$amoCRM_setting["login"] = "test@bk.ru";                      // Логин (почта)
$amoCRM_setting["api_key"] = "aaaaaa"; // API ключ из amoCRM
$amoCRM_setting["subdomain"]   = "test";                             // Поддомен (из адресной строки браузера - до ".amocrm.ru")
$amoCRM_setting["user"] = "0000";                              // Ответственный
$amoCRM_setting['source_name'] = "Тестовый источник";              // Название источника заявки
$amoCRM_setting['source_uid'] = "test-0";                     // Уникальный идентификатор заявки
$amoCRM_setting['form_id'] = 1;                             // ID формы
$amoCRM_setting['service_code'] = 1;                        // Код сервиса
$amoCRM_setting['pipline_id'] = false;                         // Неразобранное в определенную воронку
$amoCRM_setting['status_id'] = '0000';                       //  Неразобранное "false" или id этапа сделки

$amoCRM_field["phone_id"] = "0000";    // "Телефон (phone)" для контактов (id верхнего уровня)
//$amoCRM_field["email_id"]             = "";       // id поля "Email (email)"
$amoCRM_field["client_id"] = "0000";      // Источник заявки
$amoCRM_field["client_site"] = "0000";      // Название сайта (id пункта выпадающего списка)

$amoCRM_field["source_id"]                 = "0000";  // Web источник
$amoCRM_field["source_google"]             = "0000";  // Google
$amoCRM_field["source_yandex"]             = "0000";  // Yandex
$amoCRM_field["source_marketgid"]          = "0000";  // Marketgid
$amoCRM_field["source_mytarget"]           = "0000";  // myTarget
$amoCRM_field["source_facebook"]           = "0000";  // Facebook
$amoCRM_field["source_instagram"]          = "0000";  // Instagram
$amoCRM_field["source_vk"]                 = "0000";  // Vkontakte  
$amoCRM_field["source_ok"]            	   = "0000";  // Одноклассники  

$amoCRM_field["campaign_id"]               = "0000";  // Web компания
$amoCRM_field["campaign_google"]           = "0000";  // Google
$amoCRM_field["campaign_kms"]              = "0000";  // КМС
$amoCRM_field["campaign_google_rem"]       = "0000";  // Ремаркетинг google
$amoCRM_field["campaign_yandex_poisk"]     = "0000";  // Яндекс контекст
$amoCRM_field["campaign_yandex_rsya"]      = "0000";  // РСЯ Яндекс
$amoCRM_field["campaign_yandex_retarg"]    = "0000";  // Яндекс ретаргетинг
$amoCRM_field["campaign_youtube"]          = "0000";  // Youtube
$amoCRM_field["campaign_youtube_re"]       = "0000";  // Youtube Ремаркетинг 

$amoCRM_field["term_id"]                   = "0000";  // Ключевые слова (term) 
$amoCRM_field["referrer_id"]               = "0000";  // Реферальные ссылки (referrer)
$amoCRM_field["user_client_id"]            = "0000";  // Клиент пользователя
$amoCRM_field["user_ip_id"]                = "0000";  // Местоположение клиента
$amoCRM_field["roistat_id"]                = "0000";  // Roistat

$amoCRM_field["href"] = $_POST['href'];
$amoCRM_field["name"] = $_POST["name"];
$amoCRM_field["phone"] = $_POST["phone"];
$amoCRM_field["email"] = $_POST["email"];
$amoCRM_field["message"] = $_POST["message"];
$amoCRM_field["subject"] = $_POST["form_name"];
$amoCRM_field["site"] = $_POST["site"];
$amoCRM_field["source"] = $_POST["source"];
$amoCRM_field["medium"] = $_POST["medium"];
$amoCRM_field["campaign"] = $_POST["campaign"];
$amoCRM_field["content"] = $_POST["content"];
$amoCRM_field["term"] = $_POST["term"];
$amoCRM_field["referrer"] = $_POST["ref"];

$amoCRM_field["user_client"]= 'IP: ' . $_SERVER['REMOTE_ADDR'] . '; ' . $_POST["user_client"];
$amoCRM_field["user_ip"] = $_POST["user_ip"];
$amoCRM_field["roistat"]= array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : "неизвестно";


if (isset($amoCRM_field["message"]) && $amoCRM_field["message"] !== '')  {$amoCRM_field["note"] = $amoCRM_field["note"] . "\r\nСообщение: " . $amoCRM_field["message"];}

if ($_POST["source"] == "google") {$amoCRM_field["source"] = $amoCRM_field["source_google"];}
if ($_POST["source"] == "yandex") {$amoCRM_field["source"] = $amoCRM_field["source_yandex"];}
if ($_POST["source"] == "marketgid") {$amoCRM_field["source"] = $amoCRM_field["source_marketgid"];}
if ($_POST["source"] == "mytarget") {$amoCRM_field["source"] = $amoCRM_field["source_mytarget"];}
if ($_POST["source"] == "fb") {$amoCRM_field["source"] = $amoCRM_field["source_facebook"];}
if ($_POST["source"] == "insta") {$amoCRM_field["source"] = $amoCRM_field["source_instagram"];}
if ($_POST["source"] == "vk") {$amoCRM_field["source"] = $amoCRM_field["source_vk"];}
if ($_POST["source"] == "ok") {$amoCRM_field["source"] = $amoCRM_field["source_ok"];}

if ($_POST["campaign"] == "g_poisk") {$amoCRM_field["campaign"] = $amoCRM_field["campaign_google"];}
if ($_POST["campaign"] == "kms") {$amoCRM_field["campaign"] = $amoCRM_field["campaign_kms"];}
if ($_POST["campaign"] == "g_poisk_re") {$amoCRM_field["campaign"] = $amoCRM_field["campaign_google_rem"];}
if ($_POST["campaign"] == "ya_poisk") {$amoCRM_field["campaign"] = $amoCRM_field["campaign_yandex_poisk"];}
if ($_POST["campaign"] == "rsya") {$amoCRM_field["campaign"] = $amoCRM_field["campaign_yandex_rsya"];}
if ($_POST["campaign"] == "ya_poisk_re") {$amoCRM_field["campaign"] = $amoCRM_field["campaign_yandex_retarg"];}
if ($_POST["campaign"] == "youtube") {$amoCRM_field["campaign"] = $amoCRM_field["campaign_youtube"];}
if ($_POST["campaign"] == "youtube_re") {$amoCRM_field["campaign"] = $amoCRM_field["campaign_youtube_re"];}

// Содержимое полей, если пользователь их не заполнил
if (($_POST["name"] == " ") || ($_POST["name"] == "")) {$amoCRM_field["name"] = "Нет имени";}
if (($_POST["phone"] == "")   || ($_POST["phone"] == "undefined"))   {$amoCRM_field["phone"]   = "+0 000 00 00";}
if (($_POST["form_name"] == "") || ($_POST["form_name"] == "undefined")) {$amoCRM_field["subject"] = "Нет темы";}
if (($_POST["referrer"] == "undefined")) {$amoCRM_field["referrer"] = "";}


$amoCRM_setting["amoCRM"] = true;   // Использовать или нет передачу данных в amoCRM (true - да, false - нет)
$amoCRM_setting["echo"] = false;  // Для отладки (true/false). Если true, при отправке будет alert  ошибкой, но в консоле код ошибки
$amoCRM_setting["linkedLeadsID"] = 0;    // ID сделки будет определен, когда будет получен ответ. И можно будет отправить 2-ой запрос для создания контакта.

# Отправка в амо
if ($amoCRM_setting["amoCRM"] == true) {
    echo "\nОтправлен запрос на авторизацию.";
    $user = array(
        'USER_LOGIN' => $amoCRM_setting["login"],
        'USER_HASH' => $amoCRM_setting["api_key"]
    );
    $options = array(
        CURLOPT_URL => 'https://' . $amoCRM_setting["subdomain"] . '.amocrm.ru/private/api/auth.php?type=json',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($user),
    );
    amoexch($options);
    echo "\nИщем дубликаты контактных данных (почта, телефон).";
    $resp = false;
    if (isset($amoCRM_field['email'])) {
        $options = array(
            CURLOPT_URL => 'https://' . $amoCRM_setting["subdomain"] . '.amocrm.ru/private/api/v2/json/contacts/list?query=' . $amoCRM_field['email'],
            CURLOPT_CUSTOMREQUEST => 'GET',
        );
        $resp = amoexch($options);
    } elseif (isset($amoCRM_field['phone'])) {
        sleep(1);
        $options = array(
            CURLOPT_URL => 'https://' . $amoCRM_setting["subdomain"] . '.amocrm.ru/private/api/v2/json/contacts/list?query=' . $amoCRM_field['phone'],
            CURLOPT_CUSTOMREQUEST => 'GET',
        );
        $resp = amoexch($options);
    }
    if (!$amoCRM_setting['status_id']) {
        sleep(1);
        sendToUnsorted($amoCRM_setting, $amoCRM_field, $resp);
    } elseif (!$resp) { # не нашли дубликаты контактных данных
        echo "\nОтправлен запрос на создание сделки . ";
        $amoCRM_setting["linkedLeadsID"] = deal($amoCRM_setting, $amoCRM_field);  // Получаем id сделки и создаём сделку
        if (($amoCRM_setting["linkedLeadsID"] != 0) && ($amoCRM_setting["linkedLeadsID"] != "")) {
            echo "\nСоздание контакта в CRM. ";
            echo "\niID сделки: " . $amoCRM_setting["linkedLeadsID"] . " получен. \nНачата передача данных в amoCRM.";
            contact($amoCRM_setting, $amoCRM_field, 'add', $amoCRM_setting['linkedLeadsID']); // Создаем контакт, который привязываем к сделке по id
			if (!empty($amoCRM_field["note"])){
               note($amoCRM_setting, $amoCRM_field, 'add', $amoCRM_setting['linkedLeadsID']);    // отправляем примечание
            }
            echo "\nСоздана сделка. Создан контакт в который добавлен номер телефона.";
        } else echo "\nВозникла ошибка при обращении к CRM!";

    } else {
        echo "\nКонтакт с такими данными уже есть: " . $resp['response']['contacts'][0]['id'];
        $amoCRM_setting['cid'] = $resp['response']['contacts'][0]['id']; // id контакта
        $lids = $resp['response']['contacts'][0]['linked_leads_id']; // id's сделок контакта
        echo "\nОтправлен запрос на создание сделки . ";
        $lid = deal($amoCRM_setting, $amoCRM_field);  // создаём сделку и получаем её id
        echo "\nID сделки: " . $lid . " получен.";
        echo "\nПривязываем контакт к этой сделке в CRM. ";
        $lids = array_merge($lids, array($lid));
        $amoCRM_setting['LeadsID'] = $lid;
        contact($amoCRM_setting, $amoCRM_field, 'update',  $lids);  // привязываем к сделке по id
        if (!empty($amoCRM_field["note"])){
           note($amoCRM_setting, $amoCRM_field, 'update', $lids);   // отправляем примечание
        }
    }
    echo "\n# конец обмена с амо #";
}

# ф-я отправки в неразобранное
function sendToUnsorted($amoCRM_setting, $amoCRM_field, $resp){
    $unsorted['add'] = array(
        array(
            'source_name' => $amoCRM_setting['source_name'],
            'source_uid' => $amoCRM_setting['source_uid'],
            'created_at' => time(),
            'pipeline_id' => $amoCRM_setting['pipline_id'],
            'incoming_entities' =>
                array(
                    'leads' =>
                        [[
                            'name' => $amoCRM_field['subject'],                 # Имя сделки
                            'status_id' => uniqid("status_id_"),                # Статус сделки (статусы см. Информация аккаунта)
                            'price' => 0,                                       # Бюджет сделки
                            'responsible_user_id' => $amoCRM_setting["user"],   # Уникальный идентификатор ответственного пользователя (пользователи см. Информация аккаунта)
                            #'tags' => $amoCRM_field["subject"],                # Теги
                            'notes' =>
                                [[
                                'note_type'=> "4",
                                'element_type'=> "lead",
                                'text'=> $amoCRM_field["note"],
                            ]],
                            'custom_fields' => array(
                                array('id' => $amoCRM_field["email_id"],
                                    'values' => array(array('value' => $amoCRM_field["email"]))),           // Email
                                array('id' => $amoCRM_field["message_id"],
                                    'values' => array(array('value' => $amoCRM_field["message"]))),         // Сообщение
                                array('id' => $amoCRM_field["term_id"],
                                    'values' => array(array('value' => $amoCRM_field["term"]))),            // Ключевые слова
                                array('id' => $amoCRM_field["source_id"],
                                    'values' => array(array('value' => $amoCRM_field["source"]))),          // Web источник
                                array('id' => $amoCRM_field["campaign_id"],
                                    'values' => array(array('value' => $amoCRM_field["campaign"]))),        // Web Компания
                                array('id' => $amoCRM_field["client_id"],
                                    'values' => array(array('value' => $amoCRM_field["client_site"]))),     // Название сайта
                                array('id' => $amoCRM_field["referrer_id"],
                                    'values' => array(array('value' => $amoCRM_field["referrer"]))),        // Источник перехода
                                array('id' => $amoCRM_field["user_client_id"],
                                    'values' => array(array('value' => $amoCRM_field["user_client"]))),     // Клинет пользователя
                                array('id' => $amoCRM_field["user_ip_id"],
                                    'values' => array(array('value' => $amoCRM_field["user_ip"]))),         // Местоположение клиента
                                array('id' => $amoCRM_field["roistat_id"],
                                    'values' => array(array( 'value' => $amoCRM_field["roistat"])))         // Roistat
                            )
                        ]],
                    'contacts' =>
                        [[
                            'name' => $amoCRM_field["name"],     # Имя контакта
                            'custom_fields' => array(
                                array('id' => $amoCRM_field["phone_id"], # Уникальный индентификатор заполняемого дополнительного поля
                                    'values' => array(array('value' => $amoCRM_field["phone"], 'enum' => 'WORK'))),
                                array('id' => $amoCRM_field["email_id"], # Уникальный индентификатор заполняемого дополнительного поля
                                    'values' => array(array('value' => $amoCRM_field["email"], 'enum' => 'WORK'))),
                            )
                        ]],
                ),
            'incoming_lead_info' =>
                array(
                    'form_id' => $amoCRM_setting['form_id'],
                    'form_page' => $amoCRM_field["href"],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'service_code' => $amoCRM_setting['service_code'],
                    'form_name' => $amoCRM_setting['subject'],
                    'add_note' => 'Отправить дубликат договора',
                ),
        ),
    );
    $options = array(
        CURLOPT_URL => 'https://' . $amoCRM_setting["subdomain"] . '.amocrm.ru/api/v2/incoming_leads/form?login='
            .$amoCRM_setting['login'] . '&api_key=' . $amoCRM_setting['api_key'] . '&',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($unsorted),
    );
    $resp = amoexch($options, true);
}
# Ф-я создания сделки
function deal($amoCRM_setting, $amoCRM_field) {
    $lead['add'] = array(
        array(
            'name' => $amoCRM_field["subject"],
            #'status_id' => uniqid("status_id_"),          # Статус сделки (статусы см. Информация аккаунта)
            'status_id' => $amoCRM_setting['status_id'],
            'price' => 0,                                       # Бюджет сделки
            'responsible_user_id' => $amoCRM_setting["user"],   # Уникальный идентификатор ответственного пользователя (пользователи см. Информация аккаунта)
            'tags' => $amoCRM_field["subject"],                 # Теги
            'custom_fields' => array(
                array('id' => $amoCRM_field["email_id"],
                    'values' => array(array('value' => $amoCRM_field["email"]))),           // Email
                array('id' => $amoCRM_field["message_id"],
                    'values' => array(array('value' => $amoCRM_field["message"]))),         // Сообщение
                array('id' => $amoCRM_field["term_id"],
                    'values' => array(array('value' => $amoCRM_field["term"]))),            // Ключевые слова
                array('id' => $amoCRM_field["source_id"],
                    'values' => array(array('value' => $amoCRM_field["source"]))),          // Web источник
                array('id' => $amoCRM_field["campaign_id"],
                    'values' => array(array('value' => $amoCRM_field["campaign"]))),        // Web Компания
                array('id' => $amoCRM_field["client_id"],
                    'values' => array(array('value' => $amoCRM_field["client_site"]))),     // Название сайта
                array('id' => $amoCRM_field["referrer_id"],
                    'values' => array(array('value' => $amoCRM_field["referrer"]))),        // Источник перехода
                array('id' => $amoCRM_field["user_client_id"],
                    'values' => array(array('value' => $amoCRM_field["user_client"]))),     // Клинет пользователя
                array('id' => $amoCRM_field["user_ip_id"],
                    'values' => array(array('value' => $amoCRM_field["user_ip"]))),         // Местоположение клиента
                array('id' => $amoCRM_field["roistat_id"],
                    'values' => array(array( 'value' => $amoCRM_field["roistat"])))         // Roistat
            )));

    $options = array(
        CURLOPT_URL => 'https://' . $amoCRM_setting["subdomain"] . '.amocrm.ru/api/v2/leads',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($lead),
    );
    $resp = amoexch($options);
    return $resp['_embedded']['items'][0]['id']; # id созданной сделки
}
# Создание/обновление Контакта (после получения ответа при создании сделки)
function contact($amoCRM_setting, $amoCRM_field, $method, $lids)
{
    $contact[$method] = array(
        array(
            'name' => $amoCRM_field["name"],     # Имя контакта
            'leads_id' => $lids,
            'custom_fields' => array(
                array('id' => $amoCRM_field["phone_id"], # Уникальный индентификатор заполняемого дополнительного поля
                    'values' => array(array('value' => $amoCRM_field["phone"], 'enum' => 'WORK'))),
                array('id' => $amoCRM_field["email_id"], # Уникальный индентификатор заполняемого дополнительного поля
                    'values' => array(array('value' => $amoCRM_field["email"], 'enum' => 'WORK'))),
            )
        )
    );
    if ($method == 'update'){
        $contact[$method] = array(
            array(
                'id' => $amoCRM_setting['cid'],
                'updated_at' => time(),
                'leads_id' => $lids,
            )
        );
    }
    $options = array(
        CURLOPT_URL => 'https://' . $amoCRM_setting["subdomain"] . '.amocrm.ru/api/v2/contacts',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($contact),
    );
    return amoexch($options);
}

#Добавление примечания
function note($amoCRM_setting, $amoCRM_field, $method, $lids){
    if ($method == 'update'){
        echo $amoCRM_setting['LeadsID'];
        $notes['add']=array(
            array(
                'element_id'=> $amoCRM_setting['LeadsID'],
                'element_type'=>2,//1 - контакт 2-сделка 3-компания
                'note_type'=>4,
                'text' => $amoCRM_field["note"], //-примечание
            )
        );
    }
    else {
        $notes['add']=array(
            array(
                'element_id'=> $amoCRM_setting["linkedLeadsID"],
                'element_type'=>2,//1 - контакт 2-сделка 3-компания
                'note_type'=>4,
                'text' => $amoCRM_field["note"], //-примечание
            )
        );
    }
    $options = array(
        CURLOPT_URL => 'https://' . $amoCRM_setting["subdomain"] . '.amocrm.ru/api/v2/notes',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($notes),
    );
	return amoexch($options);
}



# функция обращения к API amocrm
function amoexch($options, $unsorted = false)
{
    $options = $options + array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'amoCRM-API-client/1.0',
            CURLOPT_HTTPHEADER =>  ($unsorted) ? array('Accept: application/json') : array('Content-Type: application/json'),
            CURLOPT_HEADER => false,
            CURLOPT_COOKIEFILE => dirname(__FILE__) . '/cookie.txt', #PHP>5.3.6 dirname(__FILE__) -> __DIR__
            CURLOPT_COOKIEJAR => dirname(__FILE__) . '/cookie.txt', #PHP>5.3.6 dirname(__FILE__) -> __DIR__
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0
        );
    $curl = curl_init();
    curl_setopt_array($curl, $options);
    $out = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $code = (int)$code;
    $errors = array(
        301 => 'Moved permanently',
        400 => 'Bad request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal server error',
        502 => 'Bad gateway',
        503 => 'Service unavailable'
    );
    try {
        #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
        if ($code != 200 && $code != 204)
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
    } catch (Exception $E) {
        die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
    }
    return json_decode($out, true);
}

// v. 1.0.3 18.02.2017
// добавлена метка Web источник Vkontakte и передача реферальной ссылки // v. 1.0.5  15.06.17
// Добавлена передача User Client, сокращен по высоте код   // v. 1.0.6  22.08.17
// Поправлены ответы от сервера при отправке в CRM// 1.0.7 10.20.17
// Удалён лишний код, внесена ясность с описанием функций // 1.0.8 31.10.2017
// Добавлены для передачи geo-поля (ip, страна, город); id метрики google&yandex; определение дублей сделки по номеру телефона или email; переписан код // 1.0.9 02.08.2018
// Добавление всех заявок в Неразобранное с контролем дубликатов контактных данных или на этап воронки// 1.0.10 03.08.2018
?>