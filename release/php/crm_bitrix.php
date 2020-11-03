<?
function writeToLog($data, $title = '', $form_name) {
 $log = "\n------------------------\n";
 $log .= date("Y.m.d G:i:s") . "\n";
 $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
 $log .= "Форма: " . $form_name . "\n";
 $log .= print_r($data, 1);
 $log .= "\n------------------------\n";
 file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
 return true;
}


 #if (isset($_POST["calc_crm"]) && $_POST["calc_crm"] !== '')  {$_POST["calc_crm"] = true;}		// Чекбокс

 $name 			= $_POST['name'];
 $phone 		= $_POST["phone"];
 $usermail 		= $_POST['email'];
 $message 		= $_POST['message'];
 $form_name 	= $_POST['form_name'];
 $href 		 	= $_POST['href'];
 $source     	= $_POST["source"];
 $campaign      = $_POST['campaign'];
 $content       = $_POST['content'];
 $medium        = $_POST['medium'];
 $user_ip 		= $_POST['user_ip'];
 $user_client 	= 'IP: ' . $_SERVER['REMOTE_ADDR'] . '; ' . $_POST["user_client"];
 $term       	= $_POST["term"];
 $ref 		 	= $_POST['ref'];
 $source_id 	= '375291434081';


 $queryUrl = 'https://test.bitrix24.by/rest/17/kjhirmc1za2zrors/crm.lead.add.json';
 $queryData = http_build_query(array(
 'fields' => array(
    'TITLE' => 	  $form_name,
    #'WEB_WORK' => $href,
	'NAME' => $name,
	'SOURCE_ID' => $source_id,
	#'SOURCE_DESCRIPTION' => $source_id,
	'PHONE' => Array("n0" => Array("VALUE" => $phone, "VALUE_TYPE" => "MOBILE")),
	'EMAIL' => Array("n0" => Array("VALUE" => $usermail, "VALUE_TYPE" => "WORK")),
	'OPPORTUNITY' => $calc_cost,
	'CURRENCY_ID' => 'BYN',
	'ASSIGNED_BY_ID' => 1,					/// Ответственный
	'COMMENTS' => $message,
    'UTM_CAMPAIGN' => $campaign,
    'UTM_CONTENT' => $content,
    'UTM_MEDIUM' => $medium,
    'UTM_SOURCE' => $source,
    'UTM_TERM' => $term,
    'UF_CRM_1580219716821' => $ref, 		// Реферальные ссылки
	'UF_CRM_1580219731782' => $user_client, // Клиент пользователя
	'UF_CRM_1580219743770' => $user_ip, 	// Местонахождение клиента
 ),
 'params' => array("REGISTER_SONET_EVENT" => "Y")
 ));

 $curl = curl_init();
 curl_setopt_array($curl, array(
 CURLOPT_SSL_VERIFYPEER => 0,
 CURLOPT_POST => 1,
 CURLOPT_HEADER => 0,
 CURLOPT_RETURNTRANSFER => 1,
 CURLOPT_URL => $queryUrl,
 CURLOPT_POSTFIELDS => $queryData,
 ));

 $result = curl_exec($curl);
 curl_close($curl);

 $result = json_decode($result, 1);
 

 if (array_key_exists('error', $result)) {
 	writeToLog($result, 'Form submission error',  $form_name);
 	die ("\r\nОшибка отправки в CRM: " .$result['error_description']);
 	} else {
 	echo "\r\nУспешная отправка в CRM";
 	}

 exit();


?>