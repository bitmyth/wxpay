<?php
namespace Wechat;

trait Curl
{
    public static function request($url, $postData = [], $timeout = 1000, $method = 'get')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$data) {
            $error = curl_errno($ch);
            $data = "curl出错，错误码:$error";
        }
        curl_close($ch);
        return [
            'code' => $httpCode,
            'data' => $data
        ];
    }
}
