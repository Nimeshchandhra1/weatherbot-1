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
$msg = isset($update->message->text)?$update->message->text:'';
$START_MESSAGE = $_ENV['START_MESSAGE'];
$HELP_MENU = $_ENV['HELP_MENU'];
$API_TOKEN = $_ENV['API_TOKEN'];
$IN_MSG = $_ENV['IN_MSG'];
$GP_API_KEY = $_ENV['GP_API_KEY'];
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

$data = json_decode(file_get_contents("https://api.quotable.io/random"),true);
$text = $data['content'];
$author = $data['author'];
$tag = "#" . implode(" #", $data['tags']);
$id = $data['_id'];

bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"
***QUOTES:- ***`$text`

***AUTHOR:-*** `$author`

***TAGS:-*** $tag

___ID___ :- $id",
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
}if($text == '/gn'){
$indy = json_decode(file_get_contents("https://randomuser.me/api/1.3"),true);
$gender = $indy['results'][0]['gender'];
$first = $indy['results'][0]['name']['first'];
$last = $indy['results'][0]['name']['last'];
$title = $indy['results'][0]['name']['title'];
$ssn = $indy['results'][0]['id']['value'];
$pic = $indy['results'][0]['picture']['thumbnail'];
$dob = $indy['results'][0]['dob']['date'];
$age = $indy['results'][0]['dob']['age'];
$cout = $indy['results'][0]['location']['country'];
$stree = $indy['results'][0]['location']['street']['number'];
$steet = $indy['results'][0]['location']['street']['name'];
$cell = $indy['results'][0]['cell'];
$phn = $indy['results'][0]['phone'];
$ste = $indy['results'][0]['location']['state'];
$cty = $indy['results'][0]['location']['city'];

bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***FIRST NAME:- *** $title $first

***LAST NAME:-*** $last

***GENDER:-*** $gender

***DOB***: $dob

***AGE*** : $age

***STREET*** : $stree $steet

***CITY:-*** $cty

***STATE:-*** $ste

***COUNTRY:-*** $cout

***SSN:-*** $ssn

***CELL:-*** $cell

***PHONE:-*** $phn",
'parse_mode'=>"MarkDown",
                ]);
}if ($text !== "/start"){
$indusdata = json_decode(file_get_contents("https://ncekart.vercel.app/check?id=$text"),true);
$indusmerchant = $indusdata['merchant_name'];
$indus_status = $indusdata['order_status'];
$indus_tracking = $indusdata['tracking_id'];
$indusupdate1 = implode($indusdata['updates']['0']);
$indusupdate2 = implode($indusdata['updates']['1']);
$indusupdate3 = implode($indusdata['updates']['2']);
$indusupdate4 = implode($indusdata['updates']['3']);
$indusupdate5 = implode($indusdata['updates']['4']);
$indusupdate6 = implode($indusdata['updates']['5']);
$indusupdate7 = implode($indusdata['updates']['6']);
$indusupdate8 = implode($indusdata['updates']['7']);
$indusupdate9 = implode($indusdata['updates']['8']);
$indusupdate10 = implode($indusdata['updates']['10']);
$indusinvalid = $indusdata['msg'];
if($indusdata['time']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"𝗧𝗥𝗔𝗖𝗞𝗜𝗡𝗚 𝗜𝗗 :- `$indus_tracking`
                
`𝐂𝐔𝐑𝐑𝐄𝐍𝐓 𝐒𝐓𝐀𝐓𝐔𝐒`:- ***$indus_status***

***🄼🄴🅁🄲🄷🄰🄽🅃***:- ***$indusmerchant***
               
➤  𝚁𝙴𝙲𝙴𝙽𝚃 𝚄𝙿𝙳𝙰𝚃𝙴𝚂:- 

`$indusupdate10`

`$indusupdate9`

`$indusupdate8`

`$indusupdate7`

`$indusupdate6`

`$indusupdate5`

`$indusupdate4`

`$indusupdate3`

`$indusupdate2`

`$indusupdate1`",
'parse_mode'=>"MarkDown",
                ]);
                }
}if(strpos($text,"/stats") !== false){ 
$bic = trim(str_replace("/stats","",$text));

$get = json_decode(file_get_contents("https://coronavirus-19-api.herokuapp.com/countries/$bic"),true);
$ab = $get['country'];
$cd = $get['cases'];
$ef = $get['todayCases'];
$gh = $get['todayDeaths'];
$deth = $get['deaths'];
$kl = $get['recovered'];
$mn = $get['active'];
$critic = $get['critical'];
$jok = $get['casesPerOneMillion'];
$joke = $get['deathsPerOneMillion'];
$jokee = $get['testsPerOneMillion'];
$jo = $get['totalTests'];

if($get['cases']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text'=>"***🔥🌀 CORONAVIRUS STATS 🌀🔥



🌐COUNTRY :*** $ab



***⭕ TOTAL CASES :*** $cd

***⭕ TOTAL DEATHS:*** ​$deth



***🔵 TODAY'S CASES :*** $ef

***🔵 TODAY'S DEATHS :*** $gh



***😀 RECOVERED :***  $kl

***🔴 ACTIVE CASES :*** $mn

***🔴 CRITICAL CASES:*** $critic

*Your Command* : $text ",
   'parse_mode'=>"MarkDown",
]);
   
}
}if($text !== '/start'){

$get = json_decode(file_get_contents("https://gplinks.in/api?api=$GP_API_KEY&url=$text"),true);
$short = $get['shortenedUrl'];

if($get['shortenedUrl']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text'=>"<b>Thank you for using me☺

YOUR SHORTEN URL: </b> <code>$short</code>

<b>LONG URL:</b> <code>$text</code>

<b>Shortened by $IN_MSG</b>",
   'parse_mode'=>"HTML",
]);
   
}
}
?>
