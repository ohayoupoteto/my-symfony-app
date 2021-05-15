<?php 
namespace App\Service;

class MyService{
    public function getMessage(){
        $msg = [
            'これはオリジナルのメッセージです',
            'これは新しいメッセージです',
            'うんち'
        ];
        $res = array_rand($msg);
        return $msg[$res];
    }
}
?>

