<?php
define('CRM_HOST', 'test.bitrix24.by'); 		// Домен в CRM
define('CRM_PORT', '443'); 								// Порт сервера CRM, не меняем
define('CRM_PATH', '/crm/configs/import/lead.php'); 

define('CRM_LOGIN', 'test@pragma.by'); 			// Логин CRM 
define('CRM_PASSWORD', 'test5597'); 					// Пароль CRM

if ($_POST["campaign"] == "g_poisk")       	{$campaign    = "Google";}
if ($_POST["campaign"] == "kms")           	{$campaign    = "КМС";}
if ($_POST["campaign"] == "g_poisk_re")    	{$campaign    = "Ремаркетинг google";}
if ($_POST["campaign"] == "ya_poisk")      	{$campaign    = "Яндекс контекст";}
if ($_POST["campaign"] == "rsya")          	{$campaign    = "РСЯ Яндекс";}
if ($_POST["campaign"] == "ya_poisk_re")    {$campaign    = "Яндекс ретаргетинг";}
if ($_POST["campaign"] == "youtube")   		{$campaign    = "Youtube";} 
if ($_POST["campaign"] == "youtube_re")   	{$campaign    = "Youtube Ремаргетинг";} 

if ($_POST["source"] == "google")       	{$source    = "Google";}
if ($_POST["source"] == "yandex")       	{$source    = "Yandex";}
if ($_POST["source"] == "marketgid")       	{$source    = "Marketgid";}
if ($_POST["source"] == "mytarget")       	{$source    = "myTarget";}
if ($_POST["source"] == "fb")       		{$source    = "Facebook";}
if ($_POST["source"] == "insta")       		{$source    = "Instagram";}
if ($_POST["source"] == "vk")       		{$source    = "Vkontakte";}
if ($_POST["source"] == "ok")       		{$source    = "Одноклассники";}



if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
 $name 			= $_POST['name'];
 $phone 		= $_POST["phone"];
 $usermail 		= $_POST['email'];
 $message 		= $_POST['message'];
 $form_name 	= $_POST['form_name'];

 $href 		 	= $_POST['href'];
 $source     	= $_POST["source"];
 $ref 		 	=  $_POST['ref'];

 $user_ip 		= $_POST['user_ip'];
 $user_client 	= 'IP: ' . $_SERVER['REMOTE_ADDR'] . '; ' . $_POST["user_client"];
 $term       	= $_POST["term"];

 $source_id = 'Сайт 1';
	if (strpos($href, 'domen.html') !== false) {
 $source_id = "Сайт 2";          
 }
 
   $postData = array(
    'TITLE' => 	  $form_name,
    #'WEB_WORK' => $href,
	'NAME' => $name,
	'SOURCE_ID' => $source_id,
    'PHONE_MOBILE' => $phone,
    'EMAIL' => $usermail,
	'COMMENTS' => $message,
	'' => $source, 		// Web источник
	'' => $campaign, 	// Web компания
	'' => $term, 		// Ключевые слова
	'' => $ref, 		// Реферальные ссылки
	'' => $user_client, // Клиент пользователя
	'' => $user_ip, 	// Местонахождение клиента

	#'UF_CRM_1549448295780' => 'Элемент3', 	// Для списка нужно передать такое же значение исходя из списка
   );


   if (defined('CRM_AUTH'))
   {
      $postData['AUTH'] = CRM_AUTH;
   }
   else
   {
      $postData['LOGIN'] = CRM_LOGIN;
      $postData['PASSWORD'] = CRM_PASSWORD;
   }

   $fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
   if ($fp)
   {
      $strPostData = '';
      foreach ($postData as $key => $value)
         $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);

      $str = "POST ".CRM_PATH." HTTP/1.0\r\n";
      $str .= "Host: ".CRM_HOST."\r\n";
      $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
      $str .= "Content-Length: ".strlen($strPostData)."\r\n";
      $str .= "Connection: close\r\n\r\n";

      $str .= $strPostData;

      fwrite($fp, $str);

      $result = '';
      while (!feof($fp))
      {
         $result .= fgets($fp, 128);
      }
      fclose($fp);

      $response = explode("\r\n\r\n", $result);

      $output = '<pre>'.print_r($response[1], 1).'</pre>';
   }
   else
   {
      echo 'Connection Failed! '.$errstr.' ('.$errno.')';
   }
   }

?>