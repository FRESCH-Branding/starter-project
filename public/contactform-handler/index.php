<?php

//TODO: Remove line if file is on same server
header("Access-Control-Allow-Origin: *");

//Warning: the commented code has not been tested
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

// //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


//TODO: Enable PHPMailer and sent mail with new PHPMailer()
$phpmailer_enabled = true;

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

            // $from = 'info@freschbranding.nl';
            $from = 'noreply@gotiles.nl';
            $to = 'freek.bosch@outlook.com';
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
                $body .= '<strong>Telefoonnummer:</strong> ' . strip_tags($_POST['phone']) . '<br /><br /><br />';
            }
            if(isset($_POST['message']) && $_POST['message'] != ''){
                $body .= '<strong>Bericht:</strong> <br />' . strip_tags($_POST['message']) . '<br /><br />';
            }

            //Check if PHPMailer is enabled
            if($phpmailer_enabled){

                try {
                   // Server settings
                $mail->isSMTP();                                                //Send using SMTP
                $mail->Host       = 'smtp.mijndomein.nl';                       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
                $mail->Username   = 'info@freschbranding.nl';                   //SMTP username
                $mail->Password   = 'Freschbranding98!';                        //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;             //Enable implicit TLS encryption
                $mail->Port       = 587;                                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

     
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                          //Enable verbose debug output
                // $mail->isSMTP();                                                //Send u sing SMTP
                // $mail->Host       = 'smtp-office365.com';                    //Set the SMTP server to send through
                // $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
                // $mail->Username   = 'freek.bosch@outlook.com';                  //SMTP username
                // $mail->Password   = 'Fresch98!';                                //SMTP password
                // // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                //Enable implicit TLS encryption
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                //Enable implicit TLS encryption
                // $mail->Port       = 465;                                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                


                    //Recipients
                    // $mail->setFrom($from);                      
                    // $mail->addAddress($to);
                    
                    //Recipients
                    $mail->setFrom('info@freschbranding.nl');           //emailadres van verzender (moet gelijk zijn aan de Username)
                    $mail->addAddress('mariagao40@gmail.com');       //emailadres van ontvanger
                
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
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }

            }else{    
                $headers = "MIME-Version: 1.0" . "\r\n"; 
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
    
                $mail_sent = mail($to, $subject, $body, $headers);
    
                //Check if mail() has been sent
                if($mail_sent){
                    $array_return['success'] = true;
                    $array_return['successMessage'] = 'Bedankt voor je bericht. We hebben het ontvangen en zullen er zo snel mogelijk contact opnemen.';
                }else{
                    //Error if mail() has not been sent
                    $array_return['error'] = true;
                    $array_return['errorMessage'] = 'Er is een probleem opgetreden met het versturen van de e-mail. Probeer het later opnieuw.';
                }
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