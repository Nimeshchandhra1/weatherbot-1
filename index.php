<?php
/*
BY:- @BenchamXD

CHANNEL:- @IndusBots
*/
error_reporting(0);

set_time_limit(0);

flush();
$API_KEY = $_ENV['BOT_TOKEN'];
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
	
//==============BENCHAM======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$HELP_MESSAGE = $_ENV['HELP_MESSAGE'];
$API_TOKEN = $_ENV['API_TOKEN'];
$START_MESSAGE = $_ENV['START_MESSAGE'];
$username = $update->message->from->username;
if($text == '/start')
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***$START_MESSAGE

Send me a city name to find the weather.***",
'parse_mode'=>"MarkDown",
]);

//=========================BENCHAMXD=================//
if($text !== '/start'){
$resp = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$text&appid=$API_TOKEN"),true);
$weather = $resp['weather'][0]['main'];
$description = $resp['weather'][0]['description'];
$temp = $resp['main']['temp'];
$humidity = $resp['main']['humidity'];
$feels_like = $resp['main']['feels_like'];
$country = $resp['sys']['country'];
$nme = $resp['name'];
$kelvin = 273;
$celcius = $temp - $kelvin;
$feels = $feels_like - $kelvin;
 if($weather['name']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"Weather at ***$text*** is `$weather`
                
Temp : `$celcius °C`

Feels Like : `$feels °C`

Humidity: `$humidity`

Country: `$country`",
'parse_mode'=>"MarkDown",

]);
    }
else {
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"`Sorry, I couldn't find that city or the city dosen't exist.`",
'parse_mode'=>"MarkDown",
                
]);
}
}
