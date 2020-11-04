<?php
	$to = "pragma.kontrol@yandex.ru";
	$subject = "Заявка с сайта: test.pragma.by";
	$user_name = htmlspecialchars($_POST['name']);
	$user_phone = htmlspecialchars($_POST['phone']);
	$user_mail = htmlspecialchars($_POST['mail']);
    $user_message = htmlspecialchars($_POST['message']);

	$ip = $_SERVER['REMOTE_ADDR'];
    $myApiKey = 'hJdW7dmK5FgaHkTxe4pIIdOQSETQABqruTxeAPYh';
	$ip_result = (array)json_decode(file_get_contents("https://ip-location.icu/api/v1/city/?apiKey={$myApiKey}&ip={$ip}"));
	$user_ip = "Область: " .$ip_result['region_name']. "; Город: " .$ip_result['city_name'];
	$_POST['user_ip'] = $user_ip;


	$form_name = htmlspecialchars($_POST['form_name']);
    $user_client = htmlspecialchars($_POST['user_client']);
	$href = htmlspecialchars($_POST['href']);
	$search = htmlspecialchars($_POST['search']);
	$utm_source = htmlspecialchars($_POST['source']);
	$ref =  htmlspecialchars($_POST['ref']);
	$url =  htmlspecialchars($_POST['url']);
	$medium =  htmlspecialchars($_POST['medium']);
	$campaign =  htmlspecialchars($_POST['campaign']);
	$content =  htmlspecialchars($_POST['content']);
	$utm_term =  htmlspecialchars($_POST['term']);


	$table = '';
	$wardrobe_quiz = htmlspecialchars($_POST['wardrobe_quiz']);
	$wardrobe_type = htmlspecialchars($_POST['wardrobe_type']);
	$wardrobe_material = htmlspecialchars($_POST['wardrobe_material']);
	$wardrobe_door = htmlspecialchars($_POST['wardrobe_door']);
	$wardrobe_room = htmlspecialchars($_POST['wardrobe_room']);
	$wardrobe_gift = htmlspecialchars($_POST['wardrobe_gift']);
	$wardrobe_cell = htmlspecialchars($_POST['wardrobe_cell']);


	$calc_quiz = htmlspecialchars($_POST['calc_quiz']);
	$calc_height = htmlspecialchars($_POST['calc_height']);
	$calc_length = htmlspecialchars($_POST['calc_length']);
	$calc_width = htmlspecialchars($_POST['calc_width']);
	$calc_door = htmlspecialchars($_POST['calc_door']);



	if (!empty($wardrobe_quiz)){

		$table ='<table style="width: 900px; border-collapse: collapse; margin-top: 15px;">
			<tbody>
				<tr>
					<th style="border: 1px solid #333333; padding: 5px;">Тип шкафа</th>
					<th style="border: 1px solid #333333; padding: 5px;">Материал</th>
					<th style="border: 1px solid #333333; padding: 5px;">Фасад дверей</th>
					<th style="border: 1px solid #333333; padding: 5px;">Комната</th>
					<th style="border: 1px solid #333333; padding: 5px;">Подарок</th>
					<th style="border: 1px solid #333333; padding: 5px;">Куда отправить</th>
				</tr>
				<tr>
					<td style="border: 1px solid #333333; padding: 5px;">'.$wardrobe_type.'</td>
					<td style="border: 1px solid #333333; padding: 5px;">'.$wardrobe_material.'</td>
					<td style="border: 1px solid #333333; padding: 5px;">'.$wardrobe_door.'</td>
					<td style="border: 1px solid #333333; padding: 5px;">'.$wardrobe_room.'</td>
					<td style="border: 1px solid #333333; padding: 5px;">'.$wardrobe_gift.'</td>
					<td style="border: 1px solid #333333; padding: 5px;">'.$wardrobe_cell.'</td>
				</tr>
			</tbody>
		</table>';
	}


	if (!empty($calc_quiz)){

		if (!empty($_POST['calc_additional'])){
			foreach ($_POST['calc_additional'] as $key=>$value) {
		    	$calc_additional .= htmlspecialchars($value) . "<br>";
			}
		}

		$table ='<table style="width: 900px; border-collapse: collapse; margin-top: 15px;">
			<tbody>
				<tr>
					<th style="border: 1px solid #333333; padding: 5px;">Высота, см</th>
					<th style="border: 1px solid #333333; padding: 5px;">Ширина, см</th>
					<th style="border: 1px solid #333333; padding: 5px;">Глубина, см</th>
					<th style="border: 1px solid #333333; padding: 5px;">Кол-во дверей</th>
					<th style="border: 1px solid #333333; padding: 5px;">Доборы</th>
				</tr>
				<tr>
					<td style="border: 1px solid #333333; padding: 5px;">'.$calc_height.'</td>
					<td style="border: 1px solid #333333; padding: 5px;">'.$calc_length.'</td>
					<td style="border: 1px solid #333333; padding: 5px;">'.$calc_width.'</td>
					<td style="border: 1px solid #333333; padding: 5px;">'.$calc_door.'</td>
					<td style="border: 1px solid #333333; padding: 5px;">'.$calc_additional.'</td>
				</tr>
			</tbody>
		</table>';
    }



	$message ="
	<!DOCTYPE html>
		<head>
			<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'/>
			<title></title>
		</head>
		<body style='background-color: #ffffff; color: #000000; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: 18px; font-family: helvetica, arial, verdana, sans-serif;'>
		<h2 style='background-color: #eeeeee;'>Заявка с лендинга: test.pragma.by</h2>
			<table cellspacing='0' cellpadding='0' width='80%' style='background-color: #ffffff;'>
				<tbody>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Тема:</b></td>
						<td>$form_name</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Имя:</b></td>
						<td>$user_name</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Телефон:</b></td>
						<td>$user_phone</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Почта:</b></td>
						<td>$user_mail</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Сообщение:</b></td>
						<td>$user_message</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>URL:</b></td>
						<td>$href</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Referrer (источник перехода):</b></td>
						<td>$ref</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Source: (источник кампании)</b></td>
						<td>$utm_source</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Medium: (тип трафика)</b></td>
						<td>$medium</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Campaign: (название кампании)</b></td>
						<td>$campaign</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Content: (идентифик. объявления)</b></td>
						<td>$content</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Term: (ключевые слова)</b></td>
						<td>$utm_term</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Клиент пользователя:</b></td>
						<td>$user_client</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>IP Адрес:</b></td>
						<td>$ip</td>
					</tr>
					<tr>
						<td style='width: 340px; padding-top:5px;'><b>Местонахождение клиента:</b></td>
						<td>$user_ip</td>
					</tr>
				</tbody>
			</table>
			$table	
		</body>
	</html>
	";
	$header = "From: test.pragma.by <lead@test.pragma.by> \r\nContent-type: text/html; charset=UTF-8 \r\n";
	mail($to, $subject, $message, $header);
	#include('crm.php');
	echo "Заявка принята";
	exit();

	?>