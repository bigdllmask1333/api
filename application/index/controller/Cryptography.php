<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21
 * Time: 11:24
 */

namespace app\index\controller;

use think\Controller;
use think\Request;
class Cryptography extends Controller
{
    /**
     * RSA公钥私钥生成
     */
    public function createkey(){
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


    /**
     * RSA私钥加密
     * @param string $private_key 私钥
     * @param string $data 要加密的字符串
     * @return string $encrypted 返回加密后的字符串
     * @author mosishu
     */
    function privateEncrypt(){
        $private_key=addslashes(input("post.private_key"));   //私钥
        $data=addslashes(input("post.data"));   //等待加密字符串

//        $private_key = "-----BEGIN PRIVATE KEY-----
//MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAKnKXnimeN3qsCwy
//G4Jk5VlNHRwLVZZO7uJeuQG3JrJpyXbQajSoephk+WJt8DIfKWNvo605cs/NPwWF
//wFFzGzIPC3S+TQvz1feIcyi+XZBFA7xiyOup+SiVcnpnK8vyeQl3HhFEa7hZa6Qs
//YO/TEmjceDRg3/WjeYUoIsb0S0SfAgMBAAECgYB8B6qPM/xjD8d14Xya+h1X6K71
//B4qT7EEw98Tp7eLEveY/duu+X7x+inRqZKjr1Dulua21IpwuFF6PKC9e0FjyPbuG
//qalCE5iUSNGG6S5ZVLzVzgCqA6jfe9w41ZMTdVmeKqERJUmY/+cuUNG0UxQkk9b9
//vQ6yrO6As7e3Kb9DIQJBANYEcnSLdInMEm7ay3vKUsEtEFghlIvI2h6ceT99+Pw8
//DPcFkA2/hUqysnZKCI7WrZTE5xOeT/+8kt0uumve0DcCQQDLGO5juTVLzRXUFJMP
//vzxX7NFk1EeOKyf9xee8FGcJ+Zc1i/ogXAT5/ryk3DGfdPt7DxCpj3agpBgFzIQ4
//emrZAkBMRXF0z25M3YmEMD1sdIJhjenRPsZturrhReqAEij124DTWAwqmiKqqFyp
//g2DhZuidqD6h4z2nalD8unZ9kv6pAkBFBTP+r/Js0EWazWMs9tCLEPAYVAv9RK1S
//kO8v+78IpMm+aNOYK62FSAzT+gDjL95G89e1yAuIjDudvOMyTmgBAkAssQtT/7wV
//BmJBKeaNLSfsVQlEsT5paRGSEobULXLRZG9Vsl6CKNv3jk2kW2oJHm8yazAfXyBF
//ixNExnBoJ5qi
//-----END PRIVATE KEY-----";

        openssl_private_encrypt($data, $crypted, $private_key);
// 由于php 进行openssl_public_encrypt 加密后返回的是二进制数据，需要对其返回的加密后的数据进行二进制16进制编码base64_encode才可以显示，$crypted为加密后的串
        $crypted=base64_encode($crypted);
        return $crypted;
    }


    /**
     * RSA公钥解密(私钥加密的内容通过公钥可以解密出来)
     * @param string $public_key 公钥
     * @param string $data 私钥加密后的字符串
     * @return string $decrypted 返回解密后的字符串
     * @author mosishu
     */
    function publicDecrypt(){
        $public_key=addslashes(input("post.public_key"));   //公钥
        $data=addslashes(input("post.data"));   //等待解密的字符串
//        $public_key = "-----BEGIN PUBLIC KEY-----
//MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCpyl54pnjd6rAsMhuCZOVZTR0c
//C1WWTu7iXrkBtyayacl20Go0qHqYZPlibfAyHyljb6OtOXLPzT8FhcBRcxsyDwt0
//vk0L89X3iHMovl2QRQO8YsjrqfkolXJ6ZyvL8nkJdx4RRGu4WWukLGDv0xJo3Hg0
//YN/1o3mFKCLG9EtEnwIDAQAB
//-----END PUBLIC KEY-----";

        $crypted=base64_decode($data);
        openssl_public_decrypt($crypted, $decrypted , $public_key);
        return $decrypted;
    }



    //RSA公钥加密
    function publicEncrypt(){
        $public_key=addslashes(input("post.public_key"));   //公钥
        $data=addslashes(input("post.data"));   //等待加密的字符串

        $public_key = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC2JMAJye7wZyim2vaNDwiRgH9U
yJbxGG69LFXWbfpyGCYywvz5X1qCZWyo/GdrlRETS8q1y+8q6/N0Tes/QJYgGPZC
EaYSIBXSFEt+GKn/xXn7SH47kbgtk8idUGt6yslL1s2o5b6EvI0nBzmRrS5mx+Rd
AfJ1XDP8GcDToVSCrwIDAQAB
-----END PUBLIC KEY-----";

        openssl_public_encrypt($data, $crypted, $public_key);

// 由于php 进行openssl_public_encrypt 加密后返回的是二进制数据，需要对其返回的加密后的数据进行二进制16进制编码base64_encode才可以显示，$crypted为加密后的串
        $crypted=base64_encode($crypted);
        return $crypted;
    }


    //RSA私钥解密
    function privateDecrypt(){
        $private_key=addslashes(input("post.private_key"));   //私钥
        $data=addslashes(input("post.data"));   //等待解密的字符串



        $private_key = "-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMRaB4rLYuxi/x5+
/Z/PUhm1Nf1FFsVHlhleyJ/mdtTTAt74AH/zSGiZMS+7PRZNuUIsP2bIh59MzThZ
n9YMToD/winFw/GP1gFKGHAEZls16wEumAPROlTtNHCBiHTNTDznVdQErUgAirac
0mYwxOEF23+J0R3CtuNgzVFgcg+pAgMBAAECgYEAuI5myG6jbM0gPuneOngEE2Xg
eU6XOJcw3mfY63MT/rbX2/v/fESPqsFTGipEINKtbyVn8pRJ5dGqk2yqb+bhYXZG
aSV5xI2J7aTIAr75iWTvpRbgC/z+rDbPUxbCfDSMjZg5CHVC7FCUl4DEzW+uwvXC
jPRxegdDz+KYkhvyNIECQQD97TsIjAAJGMtWqsqLGis25jE+BgQmO94dhZE106YQ
J3h0BZc94/vd6eZmP6uymqp+yL06RMd9ikNEUNQOP7n3AkEAxfRz8VZbFnAZKiED
u4pkAByTRUL+FZrzmMcq8KdMDMQ1vEu2iIBH7n5WCtX1/GKnrkgTVlZIvFbzu8UD
r4kbXwJBAOHf+ehDaPCunoosiNkt4Q0HvPvYLC66iH0oSCBicdDi23IRWxTRzUT8
gFeqAZhxnoIDHNhNQEs7B1UotUkrhMcCQBO2Oe1oSf27/+WAEB0WtMqGDewxtZd1
LJikDJSWNC55Q1iSuYRyMbeAARVnJO2S7Vufdb19LhUDG5YxEiLipkUCQFJUp+3y
3/AIQvEs/AWFlE9JUMvQGbyIaCvR4jnVV2+Pr1fPjwZ/GZcEKMZ5PPl+TQJDicFO
2rA/8rJ5dJlbQXo=
-----END PRIVATE KEY-----";

        //相应的：加密后生产的16进制加密字符串需要进行base64_decode进行解密后在进行openssl_private_decrypt
        $crypted=base64_decode($data);
        openssl_private_decrypt($crypted, $decrypted , $private_key);
        return $decrypted;
    }
}