<?php
require_once(__dir__.'/vendor/autoload.php');
use Twilio\Rest\Client;

class TwilioService {
    //Configuration
    const sid    = "Enter your SID";
    const token  = "Enter your Token";
    const from   = "+1 Enter Sender Number";
    private $twilio;

    public function __construct() {
        $this->twilio = new Client($this::sid, $this::token);
    }

    public function sendSMS($to, $msg){
        try {
            $sms = $this->twilio->messages
            ->create($to, // to
                    [
                        "body" => $msg,
                        "from" => $this::from
                    ]
            );

            return $sms->sid;
        } catch (Exception $e) {
            return "";
        }
    }

    public function makeOutboundCall($to, $msg){
        try {
            $call = $this->twilio->calls
            ->create($to, // to
                    $this::from, // from
                    [
                        "twiml" => "<Response><Say>$msg</Say></Response>"
                    ]
            );

            return $call->sid;
        } catch (Exception $e) {
            return "";
        }
    }

    public function sendFax($to, $pdflink){
        try {
            $fax = $this->twilio->fax->v1->faxes
            ->create($to, // to
                    $pdflink, // mediaUrl
                    ["from" => $this::from]
            );

            return $fax->sid;
        } catch (Exception $e) {
            return "";
        }
    }
}

?>