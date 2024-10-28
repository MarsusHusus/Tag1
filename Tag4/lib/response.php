<?php
namespace lib;


abstract class response {
    public static function successJSON(array $array = []) {
        http_response_code(response_code: 200);
        header(header: "HTTP/1.0 200 OK");
        header(header: 'Content-Type: application/json');
        echo json_encode(value: $array);
    }

    public static function errorJSON(array $array = []) { 
        http_response_code(response_code: 500);
        header(header: "HTTP/1.0 500 OK");
        header(header: 'Content-Type: application/json');
        echo json_encode(value: $array);
    }

}