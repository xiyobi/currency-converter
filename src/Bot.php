<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;
require 'src/DB.php';
class Bot {
    const API_URL = 'https://api.telegram.org/bot';
    private $token = "7020930131:AAE-2OF_-xf-lQXgxnbHFZsHVDIYpPA--_Y";

    public $client;

    public function makeRequest($method, $data = []) {
        $this->client = new Client([
            'base_uri' => self::API_URL.$this->token.'/',
            'timeout'  => 2.0,
        ]);

        $response = $this->client->request('POST',$method, ['json' => $data]);
        return json_decode($response->getBody()->getContents());
    }
    public function saveUser($chat_id, $name): bool|array
    {
        if ($this->getUser($chat_id)) {
            return false;
        }

        $query = "INSERT INTO count_bot(chat_id, name) VALUES (:chat_id,:name)";
        $db = new DB();
        return $db->conn->prepare($query)->execute([
            ':chat_id'=>$chat_id,
            ':name'=>$name
        ]);
    }
    public function getUser($chat_id) {
        $query = "SELECT * FROM count_bot WHERE chat_id=:chat_id";
        $db = new DB();
        $stmt = $db->conn->prepare($query);
        $stmt->execute(['chat_id'=>$chat_id]);
        return $stmt->fetch();
    }
}
