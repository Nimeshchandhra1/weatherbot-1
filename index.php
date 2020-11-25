<?php
/*
BY:- BenchamXd and me
*/
error_reporting(0);

set_time_limit(0);

flush();
$API_KEY = $_ENV['BOT_TOKEN']; //Your token
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
  
//==============NC======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$fromid = $update->callback_query->from->id;
$username = $update->message->from->username;
$chatid = $update->callback_query->message->chat->id;
$START_MESSAGE = $_ENV['START_MESSAGE'];
$HELP_MENU = $_ENV['HELP_MENU'];
$API_TOKEN = $_ENV['API_TOKEN'];
if($text == '/start')
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***$START_MESSAGE***",
'parse_mode'=>"MarkDown",
]);
if($text == '/joke'){
$jok = json_decode(file_get_contents('https://sv443.net/jokeapi/v2/joke/Any?type=single'),true);
$joke = $jok['joke'];
$catg = $jok['category'];
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"`$joke`

Catogery:- `$catg`

_Type /joke for more_",
'parse_mode'=>"MarkDown",
]);
}if($text == '/get'){

$data = json_decode(file_get_contents("https://quotes.cwprojects.live/random"),true);
$text = $data['text'];
$author = $data['author'];
$tag = "#" . implode(" #", $data['tags']);

bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"
***QUOTE:- ***`$text`

***AUTHOR:-*** `$author`

***TAGS:-*** $tag",
'parse_mode'=>"MarkDown",
                ]);
}if($text == '/help')
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"$HELP_MENU"
]);
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
}if(strpos($text,"/bin") !== false){ 
$bin = trim(str_replace("/bin","",$text)); 
$data = json_decode(file_get_contents("https://lookup.binlist.net/$bin"),true);
$bank = $data['bank']['name'];
$country = $data['country']['alpha2'];
$currency = $data['country']['currency'];
$emoji = $data['country']['emoji'];
$scheme = $data['scheme'];
$Brand = $data['brand'];
$type = $data['type'];
 if($data['scheme']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***VALID BIN✅
                
Bin: $bin

Type: $scheme

Brand : $Brand

Bank: $bank

Country: $country $emoji

Currency: $currency

Credit/Debit:$type

Checked By @$username***",
'parse_mode'=>"MarkDown",
]);
    }
}if($text == '/gen'){

$usr = json_decode(file_get_contents("https://randomuser.me/api"),true);
$first = $usr['name']['first'];
$last = $usr['last'];
$gender = $usr['gender'];
$dob = $usr['dob']['date'];
$age = $usr['dob']['age'];
$street = $usr['location']['$street'];


bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"
***FIRST NAME:- ***`$first`

***LAST NAME:-*** `$last`

***DOB***: $dob

***Age*** : $age

***Street*** : $street

***GENDER:-*** $gender",
'parse_mode'=>"MarkDown",
                ]);
}
