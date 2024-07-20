<?php

header("Acces-Control-Allow-Origin: *");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$array_return = array(); 

$array_return['success'] = false;
$array_return['successMessage'] = '';

$array_return['error'] = false;
$array_return['errorMessage'] = '';

//Check if method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $array_return['postData'] = $_POST;

    //Check if client-side reCAPTCHA token has been set
    if(isset($_POST['recaptcha']) && $_POST['recaptcha'] != ''){

        $url = "https://www.google.com/recaptcha/api/siteverify";

        $recaptcha_secret_key = "6LdoymApAAAAAMT1UnlNIY_Sagp-eVvlRaMVZ1Y7";
        $recaptcha_response = $_POST['recaptcha']; 

        $data = [
            "secret" => $recaptcha_secret_key,
            "response" => $recaptcha_response,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
   
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            //Error if cURL request has errors
            $array_return['error'] = true;
            $array_return['errorMessage'] = 'Er is een probleem opgetreden bij het verwerken van het verzoek naar reCAPTCHA. Probeer het later opnieuw.';
        }

        curl_close($ch);

        $result = json_decode($result, true);
        $array_return['result'] = $result;

        //Check if Google reCAPTCHA validation is success and passes the threshold score
        if ($result["success"] && $result["score"] >= 0.5) {

            $from = 'noreply@gotiles.nl';
            //TODO: Change $to e-mail address
            $to = 'jordy@flyingkiwi.nl';
            $subject = 'GoTiles: Nieuwe contactaanvraag ontvangen';
            $body = '';

            $body .= 'Beste Luuk & Frank, <br /><br />';
            $body .= 'Er is zojuist een nieuwe contactaanvraag verzonden via het contactformulier op de website van GoTiles. Hierbij de ingezonden gegevens:<br /><br />';

            if(isset($_POST['name']) && $_POST['name'] != ''){
                $body .= '<strong>Naam:</strong> ' . strip_tags($_POST['name']) . '<br />';
            }
            if(isset($_POST['email']) && $_POST['email'] != ''){
                $body .= '<strong>E-mailadres:</strong> ' . strip_tags($_POST['email']) . '<br />';
            }
            if(isset($_POST['phone']) && $_POST['phone'] != ''){
                $body .= '<strong>Telefoonnummer:</strong> ' . strip_tags($_POST['phone']) . '<br />';
            }
            if(isset($_POST['message']) && $_POST['message'] != ''){
                $body .= '<strong>Bericht:</strong> <br />' . strip_tags($_POST['message']) . '<br /><br />';
            }

            try {
                // Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp-mail.outlook.com';                //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'freek.bosch@outlook.com';              //SMTP username
                $mail->Password   = 'Fresch98!';                            //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
           
                //Recipients
                $mail->setFrom($from);
                $mail->addAddress($to);
                // $mail->addCC('jordy@flyingkiwi.nl');
                // $mail->addBCC('jordy@flyingkiwi.nl');

                $mail->isHTML(true);                                            //Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $body;                
                $mail->send();

                $array_return['success'] = true;
                $array_return['successMessage'] = 'Bedankt voor je bericht. We hebben het ontvangen en zullen er zo snel mogelijk contact opnemen.';

            } catch (Exception $e) {
                //Error if there is something wrong in PHPMailer try{}
                $array_return['error'] = true;
                $array_return['errorMessage'] = 'Er is een probleem opgetreden met het versturen van de e-mail. Probeer het later opnieuw.';
            }

        }else{
            //Error if Google reCAPTCHA validation is not success or doesn't passes the threshold score
            $array_return['error'] = true;
            $array_return['errorMessage'] = 'Er is een probleem opgetreden met de reCAPTCHA-verificatie. Probeer het later opnieuw.';
        }

    }else{
        //Error if client-side recaptcha has not been set
        $array_return['error'] = true;
        $array_return['errorMessage'] = 'Er is een probleem opgetreden bij het verwerken van reCAPTCHA. Probeer het later opnieuw.';
    }

}else{
    //Error if method is not POST
    $array_return['error'] = true;
    $array_return['errorMessage'] = 'Er is een probleem opgetreden bij het verwerken van het verzoek. Probeer het later opnieuw.';
}

$array_return = json_encode($array_return);

echo $array_return;