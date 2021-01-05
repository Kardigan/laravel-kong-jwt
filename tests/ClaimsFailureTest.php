<?php

use Kardigan\LaravelKongJwt\Jwt;

class ClaimsFailureTest extends \PHPUnit\Framework\TestCase
{

    public function testIrregularData()
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MTQyLCJjdXN0b21lcl9pZCI6MzQsImRlcGFydG1lbnRzIjpbMTFdLCJuYW1lIjoiQ09PUCBEZW1vIC0gQnJhbmRzYWZlIGJydWtlciIsInVzZXJuYW1lIjoiYnNjb29wIiwicGhvbmUiOm51bGwsImVtYWlsIjpudWxsLCJsYW5ndWFnZSI6Im5vIiwicHJvZmlsZSI6ImRlbW8iLCJyb2xlIjp7InRpdGxlIjoiVmlld2VyIiwiY2FwYWJpbGl0aWVzIjpbIndvcmtsaXN0LXJlYWQiLCJwcm9kdWN0LnNlYXJjaCJdfSwiaXNzIjoiZktsMjAzeFM4Y1JUN2RhOVhOcmJMSXV3bk5UQVk5cUciLCJpYXQiOjE1NTA0ODAyODUsImV4cCI6MTU1MDQ4MjA4NX0.QqKzxfHvuMaqKQMLhObI6Lx9TTMM-wffx5RD3iiHnnM';

        $jwt = new Jwt();

        $jwt_str = $jwt->base64Decode($token);

        $claims = $jwt->getClaims($jwt_str);

        $this->assertTrue(is_array($claims));

        $this->assertEmpty($claims);

        #var_dump($claims);die;

    }

}