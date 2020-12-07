<?php
/*
SOURCE CODE BY:- @Benchamxd
CHANNEL:- @INDUSBOTS
PLEASE DONT REMOVE THE CREDIT
*/
error_reporting(0);

set_time_limit(0);

flush();
define('API_KEY','1443581629:AAG67TE-sesAPbiFxPwRlGVPyYdpmOF1WqU');
/////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
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
$update = json_decode(file_get_contents('php://input'));
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$name = $update->message->from->first_name;
$log = -1001220959484;
$kanal = "indusbots";
$text = $message->text;

if($text !== '/start'){
$GetInfo = json_decode(file_get_contents("https://openiban.com/validate/$text?getBIC=true&validateBankCode=true"),true);
$value = $GetInfo['valid'];
$indusbots1 = $GetInfo['iban'];
$indusbots2 = $GetInfo['bankData']['bankCode'];
$indusbots3 = $GetInfo['bankData']['name'];
$indusbots4 = $GetInfo['bankData']['bic'];
$indusbots5 = $GetInfo['messages'][0];
 if($indusbots1['iban']){
indusbots('sendMessage',[
                'chat_id'=>$chat_id,
                'text'=> "***VALID IBAN✅***

***IBAN*** :- `$indusbots1`

***BANK CODE*** :- `$indusbots2`

***BANK NAME*** :- `$indusbots3`

***BIC*** :- `$indusbots4`

***RESPONCE*** :- `$indusbots5`

***THANKS TO @BENCHAMXD FOR THIS SOURCE***
",
'parse_mode'=>"MarkDown",
  ]);
    }
}
