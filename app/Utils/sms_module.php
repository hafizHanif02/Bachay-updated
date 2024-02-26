<?php

namespace App\Utils;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Nexmo\Laravel\Facade\Nexmo;
use Twilio\Rest\Client;

class SMS_module
{
    public static function send($receiver, $otp)
    {

                    $curl = curl_init();
                    $url = 'https://graph.facebook.com/v18.0/235106213008560/messages';
                        curl_setopt($curl, CURLOPT_URL, $url);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization:Bearer EAAFTwPfvu6IBOxon9H1g7FDwrP30To11IHXYTOPQFTRZCshZCDC5dyfwYCzXZB9UamL8meP8rzbMyOgFFvmPPBnbxMcLs8qf49pqipkXGonoMxxuEUAmxrGy91vO86JpsnZAZBELefAoDQJHjD0oZAkG6k8SuelUK6viLUQAIbOl694ZAJf0xd2vR8PHonnKs9PMCDZCPr82K4Kh5rU8', 'Content-Type: application/json'));
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $data = array(
                            "messaging_product" => "whatsapp",
                            "recipient_type" => "individual",
                            "to" => $receiver,
                            "type" => "template",
                            "template" => array(
                                "name" => "bachay_otp",
                                "language" => array(
                                    "code" => "en"
                                ),
                                "components" => array(
                                    array(
                                        "type" => "body",
                                        "parameters" => array(
                                            array(
                                                "type" => "text",
                                                "text" => $otp
                                            )
                                        )
                                    ),
                                    array(
                                        "type" => "button",
                                        "sub_type" => "url",
                                        "index" => "0",
                                        "parameters" => array(
                                            array(
                                                "type" => "text",
                                                "text" => $otp
                                            )
                                        )
                                    )
                                )
                            )
                        );
                        
                        $fields_string = json_encode($data);
                        // echo $fields_string;
                        // echo $fields_string;
                        // echo "<br/>";
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
                        $resp = curl_exec($curl);
                        curl_close($curl);
                        // return $resp;
                        return "success";

                    
        $config = self::get_settings('twilio');
        if (isset($config) && $config['status'] == 1) {
            return self::twilio($receiver, $otp);
        }

        $config = self::get_settings('nexmo');
        if (isset($config) && $config['status'] == 1) {
            $response = self::nexmo($receiver, $otp);
            return $response;
        }

        $config = self::get_settings('2factor');
        if (isset($config) && $config['status'] == 1) {
            $response = self::two_factor($receiver, $otp);
            return $response;
        }

        $config = self::get_settings('msg91');
        if (isset($config) && $config['status'] == 1) {
            $response = self::msg_91($receiver, $otp);
            return $response;
        }

        $config = self::get_settings('releans');
        if (isset($config) && $config['status'] == 1) {
            $response = self::releans($receiver, $otp);
            return $response;
        }

        return 'not_found';
    }

    public static function twilio($receiver, $otp)
    {
        $config = self::get_settings('twilio');
        $response = 'error';
        if (isset($config) && $config['status'] == 1) {
            $message = str_replace("#OTP#", $otp, $config['otp_template']);
            $sid = $config['sid'];
            $token = $config['token'];
            try {
                $twilio = new Client($sid, $token);
                $twilio->messages
                    ->create($receiver, // to
                        array(
                            "messagingServiceSid" => $config['messaging_service_sid'],
                            "body" => $message
                        )
                    );
                $response = 'success';
            } catch (\Exception $exception) {
                $response = 'error';
            }
        }
        return $response;
    }

    public static function nexmo($receiver, $otp)
    {
        $sms_nexmo = self::get_settings('nexmo');
        $response = 'error';
        if (isset($sms_nexmo) && $sms_nexmo['status'] == 1) {
            $message = str_replace("#OTP#", $otp, $sms_nexmo['otp_template']);
            try {
                $config = [
                    'api_key' => $sms_nexmo['api_key'],
                    'api_secret' => $sms_nexmo['api_secret'],
                    'signature_secret' => '',
                    'private_key' => '',
                    'application_id' => '',
                    'app' => ['name' => '', 'version' => ''],
                    'http_client' => ''
                ];
                Config::set('nexmo', $config);
                Nexmo::message()->send([
                    'to' => $receiver,
                    'from' => $sms_nexmo['from'],
                    'text' => $message
                ]);
                $response = 'success';
            } catch (\Exception $exception) {
                $response = 'error';
            }
        }
        return $response;
    }

    public static function two_factor($receiver, $otp)
    {
        $config = self::get_settings('2factor');
        $response = 'error';
        if (isset($config) && $config['status'] == 1) {
            $api_key = $config['api_key'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://2factor.in/API/V1/" . $api_key . "/SMS/" . $receiver . "/" . $otp . "",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if (!$err) {
                $response = 'success';
            } else {
                $response = 'error';
            }
        }
        return $response;
    }

    public static function msg_91($receiver, $otp)
    {
        $config = self::get_settings('msg91');
        $response = 'error';
        if (isset($config) && $config['status'] == 1) {
            $receiver = str_replace("+", "", $receiver);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.msg91.com/api/v5/otp?template_id=" . $config['template_id'] . "&mobile=" . $receiver . "&authkey=" . $config['authkey'] . "",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "{\"OTP\":\"$otp\"}",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if (!$err) {
                $response = 'success';
            } else {
                $response = 'error';
            }
        }
        return $response;
    }

    public static function releans($receiver, $otp)
    {
        $config = self::get_settings('releans');
        $response = 'error';
        if (isset($config) && $config['status'] == 1) {
            $curl = curl_init();
            $from = $config['from'];
            $to = $receiver;
            $message = str_replace("#OTP#", $otp, $config['otp_template']);

            try {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.releans.com/v2/message",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "sender=$from&mobile=$to&content=$message",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ".$config['api_key']
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $response = 'success';
            } catch (\Exception $exception) {
                $response = 'error';
            }

        }
        return $response;
    }

    public static function get_settings($name)
    {
        try {
            $config = DB::table('addon_settings')->where('key_name', $name)
                ->where('settings_type', 'sms_config')->first();
        } catch (\Exception $exception) {
            return null;
        }

        return (isset($config)) ? json_decode($config->live_values, true) : null;
    }
}
