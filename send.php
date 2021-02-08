<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
    $nedv = $_POST['tip_nedv'];
    $remont = $_POST['tip_remont'];
    $ploshad = $_POST['ploshad'];
    $nachat = $_POST['kogda_nachat'];
    $otpravka = $_POST['programms'];
// Формирование самого письма
$title = "Заголовок письма";
$body = "
<h2>Новое письмо</h2>
<b>Имя:</b> $name<br>
<b>Почта:</b> $email<br><br>
<b>Сообщение:</b><br>$text
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'cool-dev@bk.ru'; // Логин на почте
    $mail->Password   = 'Trishin061195'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('cool-dev@bk.ru', 'Антон'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('tosha.trishin@bk.ru');  // Куда придут данные
    $mail->addAddress('youremail@gmail.com'); // Ещё один, если нужен

    // Прикрипление файлов к письму
if (!empty($file['name'][0])) {
    for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
        $filename = $file['name'][$ct];
        if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
            $rfile[] = "Файл $filename прикреплён";
        } else {
            $rfile[] = "Не удалось прикрепить файл $filename";
        }
    }   
}
// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = ' Пользователь оставил свои данные<br>
                Тип недвижимости: '.$nedv.'<br>
                Тип ремонта: '.$remont.'<br>
                Площадь помещения: '.$ploshad.'<br>
                Когда планируете начать: '.$nachat.'<br>
                Куда отправить расчет: '.$otpravka.'
                ';    

// Проверяем отравленность сообщения
if ($mail->send()) {
    return true;
} else {
    return false;
}
} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);
//header (location: "thank.html")
