<?php

require 'assets/libs/sendgrid-php/sendgrid-php.php';

date_default_timezone_set('Etc/UTC');

$start = microtime(true);
$sendgrid = new SendGrid('MessageBot', 'MessageBot123');
$mail = new SendGrid\Email();

$mail->setFrom('messagebot123@gmail.com');

$url = null;
$carrierDomain = null;
$mail->setText('error');

if($_POST['type']==='text'){
    
    switch ($_POST['carrier']) {
        case 'verizon':
            $carrierDomain = 'vtext.com';
            break;
        case 'sprint':
            $carrierDomain = 'messaging.sprintpcs.com ';
            break;
        case 'at&t':
            $carrierDomain = 'txt.att.net';
            break;
        case 'tmobile':
            $carrierDomain = 'tmomail.net';
            break;
        case 'virginmobile':
            $carrierDomain = 'vmobl.com';
            break;
        case 'tracfone':
            $carrierDomain = 'mmst5.tracfone.com';
            break;
        case 'metropcs':
            $carrierDomain = 'mymetropcs.com';
            break;
        case 'boostmobile':
            $carrierDomain = 'myboostmobile.com';
            break;
        case 'cricket':
            $carrierDomain = 'sms.mycricket.com';
            break;
        case 'nextel':
            $carrierDomain = 'messaging.nextel.com';
            break;
        case 'alltel':
            $carrierDomain = 'message.alltel.com';
            break;
        case 'ptel':
            $carrierDomain = 'ptel.com';
            break;
        case 'suncom':
            $carrierDomain = 'tms.suncom.com';
            break;
        case 'qwest':
            $carrierDomain = 'qwestmp.com';
            break;
        case 'uscellular':
            $carrierDomain = 'email.uscc.net';
            break;
    }
    
    if (isset($carrierDomain)) {
        $url = $_POST['phoneNumber'].'@'.$carrierDomain;
    }
    
    $mail->setSubject('MessageBot');
    $mail->setText($_POST['tBody']);
    
} elseif ($_POST['type']==='email'){
    
    $url = $_POST['email'];
    $mail->setSubject($_POST['subject']);
    $mail->setText($_POST['eBody']);
    
}

if (isset($url)) {
    $mail->addTo($url);
}

$amount = 0;

if ($_POST['amount']>10) {
    $amount=10;
} else {
    $amount = $_POST['amount'];
}

echo '<title>Message Sent</title>';
echo '<a href="/messagebot">Go Back</a><br/><p id="messageStatus">Message Status: Success!</p><hr/><br/>';
echo "DEBUG:<br/>";

for ($i=1; $i<=$amount; $i++) {
    try {
        $sendgrid->send($mail);
    } catch(\SendGrid\Exception $e) {
        echo $e->getCode();
        foreach($e->getErrors() as $er) {
            echo $er;
        }
        echo '<script>document.getElementById("messageStatus").innerHTML="Message Status: Failed!"</script>';
    }
}

echo "<br/>";
echo "Time taken to process request: ".round(microtime(true) - $start, 3)."sec<br>";