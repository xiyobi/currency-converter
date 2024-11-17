<?php
    define('API_KEY', '7948764682:AAFzp04PlOMtipnnyg6GH4zbf6Ci_TtCivc');
    function del($name)
    {
        array_map('unlink', glob("$name/*.*"));
    }
    function put($fayl,$nima)
    {
        file_put_contents("$fayl","$nima");
    }
    function pslep($cid,$zn)
    {
        file_put_contents("step/$cid.step",$zn);
    }
    function step($cid)
    {
        $step = file_get_contents("step/$cid.step");
        $step += 1;
        file_put_contents("step/$cid.step",$step);
    }
    function nextTx($cid,$txt)
    {
        $step = file_get_contents("step/$cid.txt");
        file_put_contents("step/$cid.txt",$txt);
    }
    function ty($ch)
    {
        return bot("sendChatAction",[
            "chat_id" => $ch,
            "action" => "typing",
        ]);
    }
    function ACL($callbackQueryIa,$text=null, $showalert=false)
    {
        return bot ("sendCallbackQuery",[
            'callbackQuery_id' => $callbackQueryIa,
            'text' => $text,
            'showalert' => $showalert,
        ]);
    }
    function bot($method,$datas=[]){
        $url = "https://api.telegram.org/bot".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = curl_exec($ch);
        if(curl_errno($ch)) {
            var_dump(curl_error($ch));
        }
        else {
            return json_decode($res);
        }
     }
    $updata = json_decode(file_get_contents('php://input'));
    $message = $updata->message;
    $cid = $message->chat->id;
    $cidltyp = $message->chat->type;
    $mild = $message->massage_id;
    $name = $message->from->first_name;
    $user = $message->from->username;
    $tx = $message->text;
    $callback = $updata->callback_query;
    $mmid = $callback->inline_message_id;
    $mes = $callback->query;
    $mid = $mes->from->id;
    $cmtx = $mes->text;
    $mmid=$callback->inline_message_id;
    $idd = $callback->massage->chat->id;
    $cbid = $callback->from->id;
    $cbuser = $callback->from->username;
    $data = $callback->data;
    $ida= $callback->id;
    $cqid=$updata->callback_query->data;
    $cbins = $callback->chat_instance;
    $cbchtyp = $callback->massage->chat_type;
    $step = file_get_contents("step/$cid.step");
    $menu = file_get_contents("step/$cid.menu");
    $stepe = file_get_contents("step/$cbid.step");
    $menue = file_get_contents("step/$cbid.menu");
    mkdir("step");

    $cancel = "Bekor qiish ";
    $keys = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text'=>"Kurslar"],],
            [['text'=>"Biz haqimizda"],['text'=>"Aloqa"],],
            [['text'=>"Manzil"],['text'=>"Ro'yhatdan otish"],],
        ]
    ]);
    $otmen = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text'=>"$cancel"],],
        ]
    ]);
    $manzil = json_encode([
        'resize_keyboard' => true,


    ]);