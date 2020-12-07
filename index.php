<?php
/*
AUTHOR:- RITHUNAND K [BENCHAMXD]

CHANNEL:- @INDUSBOTS

THIS REPO IS LICENSED UNDER GENERAL PUBLIC LICENSE VERSION 3.
*/
error_reporting(0);

set_time_limit(0);

flush();
$API_KEY = $_ENV['API_KEY'];
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
	function sendaction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
//==============BENCHAM======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$username = $update->message->from->username;
$START_MESSAGE = $_ENV['START_MESSAGE'];
//===============BENCHAM=============//
if ($text == "/start") {

            bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***$START_MESSAGE

Send your Ekart Tracking ID***",
 'parse_mode'=>'MarkDown',
            
        ]);
 }
if ($text !== "/start"){
$indusdata = json_decode(file_get_contents("https://openiban.com/validate/$text?getBIC=true&validateBankCode=true"),true);
$indus = $indusdata['valid'];
$ind = $indusdata['iban'];
$indusu = $indusdata['bankData']['bankCode'];
$indu = $indusdata['bankData']['name'];
$indusup = $indusdata['bankData']['bic'];
$indusupd = $indusdata['messages'][0];
if($indusdata['iban']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"Tʀᴀᴄᴋɪɴɢ ɪᴅ :- $ind
 $indusu
 $indu
 $indusup",
'parse_mode'=>"MarkDown",
                ]);
                }
}
 
