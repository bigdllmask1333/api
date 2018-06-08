<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21
 * Time: 15:20
 */

function dsa(){
    $private_key = "-----BEGIN PRIVATE KEY-----
MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAKnKXnimeN3qsCwy
G4Jk5VlNHRwLVZZO7uJeuQG3JrJpyXbQajSoephk+WJt8DIfKWNvo605cs/NPwWF
wFFzGzIPC3S+TQvz1feIcyi+XZBFA7xiyOup+SiVcnpnK8vyeQl3HhFEa7hZa6Qs
YO/TEmjceDRg3/WjeYUoIsb0S0SfAgMBAAECgYB8B6qPM/xjD8d14Xya+h1X6K71
B4qT7EEw98Tp7eLEveY/duu+X7x+inRqZKjr1Dulua21IpwuFF6PKC9e0FjyPbuG
qalCE5iUSNGG6S5ZVLzVzgCqA6jfe9w41ZMTdVmeKqERJUmY/+cuUNG0UxQkk9b9
vQ6yrO6As7e3Kb9DIQJBANYEcnSLdInMEm7ay3vKUsEtEFghlIvI2h6ceT99+Pw8
DPcFkA2/hUqysnZKCI7WrZTE5xOeT/+8kt0uumve0DcCQQDLGO5juTVLzRXUFJMP
vzxX7NFk1EeOKyf9xee8FGcJ+Zc1i/ogXAT5/ryk3DGfdPt7DxCpj3agpBgFzIQ4
emrZAkBMRXF0z25M3YmEMD1sdIJhjenRPsZturrhReqAEij124DTWAwqmiKqqFyp
g2DhZuidqD6h4z2nalD8unZ9kv6pAkBFBTP+r/Js0EWazWMs9tCLEPAYVAv9RK1S
kO8v+78IpMm+aNOYK62FSAzT+gDjL95G89e1yAuIjDudvOMyTmgBAkAssQtT/7wV
BmJBKeaNLSfsVQlEsT5paRGSEobULXLRZG9Vsl6CKNv3jk2kW2oJHm8yazAfXyBF
ixNExnBoJ5qi
-----END PRIVATE KEY-----";

    $public_key = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCpyl54pnjd6rAsMhuCZOVZTR0c
C1WWTu7iXrkBtyayacl20Go0qHqYZPlibfAyHyljb6OtOXLPzT8FhcBRcxsyDwt0
vk0L89X3iHMovl2QRQO8YsjrqfkolXJ6ZyvL8nkJdx4RRGu4WWukLGDv0xJo3Hg0
YN/1o3mFKCLG9EtEnwIDAQAB
-----END PUBLIC KEY-----";


    $data="原始数据为: 用私钥加密origin data1";
    $method="AES-128-CBC";

//通过私钥加密，生成$crypted;
    openssl_private_encrypt($data, $crypted, $private_key);

// 由于php 进行openssl_public_encrypt 加密后返回的是二进制数据，需要对其返回的加密后的数据进行二进制16进制编码base64_encode才可以显示，$crypted为加密后的串
    $crypted=base64_encode($crypted);

    echo "私钥加密后的结果为:".$crypted."\n";

    echo "<hr>";

//相应的：加密后生产的16进制加密字符串需要进行base64_decode进行解密后在进行openssl_private_decrypt
    $crypted=base64_decode($crypted);


    openssl_public_decrypt($crypted, $decrypted , $public_key);

    echo "用公钥解密的结果为".($decrypted)."\n";

    echo "<hr>";
    echo"===================我是分割线==============\n";
    $data="用公钥加密origin data2\n";
    $method="AES-128-CBC";

//通过公钥加密，生成$crypted;
    openssl_public_encrypt($data, $crypted, $public_key);

// 由于php 进行openssl_public_encrypt 加密后返回的是二进制数据，需要对其返回的加密后的数据进行二进制16进制编码base64_encode才可以显示，$crypted为加密后的串
    $crypted=base64_encode($crypted);

    echo "公钥加密后的结果为:".$crypted."\n";

    echo "<hr>";

//相应的：加密后生产的16进制加密字符串需要进行base64_decode进行解密后在进行openssl_private_decrypt
    $crypted=base64_decode($crypted);


    openssl_private_decrypt($crypted, $decrypted , $private_key);

    echo "<hr>";

    echo "用私钥解密的结果为:".($decrypted)."\n";
}

/**
 * RSA公钥私钥生成
 */
function createkey(){
    //创建公钥和私钥
    $res=openssl_pkey_new(array('private_key_bits' => 1024)); #此处512必须不能包含引号。

//提取私钥
    openssl_pkey_export($res, $private_key);

//生成公钥
    $public_key=openssl_pkey_get_details($res);
    /*Array
    (
        [bits] => 512
        [key] =>
        [rsa] =>
        [type] => 0
    )*/
    $public_key=$public_key["key"];

    //显示数据

    echo "<pre>";

    var_dump($private_key);
    var_dump($public_key);
    echo "</pre>";
}