<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
class Index extends Controller
{
    public function index()
    {
//        $this->redirect('Index/v1', ['cate_id' => 2]);
        $this->success('新增成功', 'Index/v1');
    }

    public function v1(){
        $data=array();
        $data['status']=1;
        $data['message']="你在干嘛？";
        return json_encode($data);
    }


    public function v2(){
        $res_data=array();
//        $ordertest      = addslashes(input("post.ordertest"));
        $ordertest=input('post.ordertest');
//        $ordertest=$_POST['ordertest'];
        $res_data['status'] = '1';
        $res_data['message'] = 'ok';
        $res_data['data']=$ordertest;
        return json_encode($res_data);
    }

    /**
     * 此处只能拿到名称跟数量
     */
    /* http://cssnb.com/index.php/Tool/index/newslist*/
    public function newslist(){
        $url = 'http://tuijian.hao123.com/?type=hotrank';
        $contents1 = file_get_contents("compress.zlib://".$url);   //规避中文乱码的现象
        $isMatched1 = preg_match_all('#<div class="points">(.*)<div class="top top-blue" monkey="jr">#isU', $contents1, $matches1);  //preg_match_all('#需要匹配的内容#isU', $contents1, $matches1);
        $isMatched2 = preg_match_all('#<span class="point-title">(.*)</span>#isU',$matches1[0][0],$matches2);
        $isMatched3 = preg_match_all('#<span class="point-index">(.*)</span>#isU',$matches1[0][0],$matches3);
        $data['content']=$matches2[1];
        $data['num']=$matches3[1];
        foreach ($data['content'] as $key => $value) {
            $arr['content']=$value;
            $arr['num']=$data['num'][$key];
            $cc[]=$arr;
        }
        $datas=json_encode($cc);
        echo $datas;
    }

    /**
     *  source===>实时热点
     * 'content' => string '关键词'
     * 'num' => string '搜索指数'
     */
    public function everyTimeNews(){
        $url = 'http://tuijian.hao123.com/?type=hotrank';
        $contents1 = file_get_contents("compress.zlib://".$url);   //规避中文乱码的现象
        preg_match_all('#<div class="points">(.*)<div class="top top-blue" monkey="jr">#isU', $contents1, $matches1);  //preg_match_all('#需要匹配的内容#isU', $contents1, $matches1);
        preg_match_all('#<span class="point-title">(.*)</span>#isU',$matches1[0][0],$matches2);
        preg_match_all('#<span class="point-index">(.*)</span>#isU',$matches1[0][0],$matches3);
        /*填充数组了*/
        $data=array();
        for ($x=1; $x<11; $x++) {
            $data[$x]['content']=$matches2[1][$x];
            $data[$x]['num']=$matches3[1][$x];
        }
        $data=json_encode($data,true);
        return $data;
    }


    /**
     *  source===>今日热点
     * 'content' => string '关键词'
     * 'num' => string '搜索指数'
     */
    public function todayHotNews(){
        $url = 'http://tuijian.hao123.com/?type=hotrank';
        $contents1 = file_get_contents("compress.zlib://".$url);   //规避中文乱码的现象
        preg_match_all('#<h2 class="title">今日热点</h2><div class="points">(.*)<div class="top top-yellow" monkey="ms">#isU', $contents1, $matches1);  //preg_match_all('#需要匹配的内容#isU', $contents1, $matches1);
        preg_match_all('#<span class="point-title">(.*)</span>#isU',$matches1[0][0],$matches2);
        preg_match_all('#<span class="point-index">(.*)</span>#isU',$matches1[0][0],$matches3);
        /*填充数组了*/
        $data=array();
        for ($x=1; $x<11; $x++) {
            $data[$x]['content']=$matches2[1][$x];
            $data[$x]['num']=$matches3[1][$x];
        }
        $data=json_encode($data,true);
        return $data;
    }


    /**
     *  source===>民生热点
     * 'content' => string '关键词'
     * 'num' => string '搜索指数'
     */
    public function peopleLiveHotNews(){
        $url = 'http://tuijian.hao123.com/?type=hotrank';
        $contents1 = file_get_contents("compress.zlib://".$url);   //规避中文乱码的现象
        preg_match_all('#<h2 class="title">民生热点</h2>(.*)<div class="top first-col" monkey="dy">#isU', $contents1, $matches1);  //preg_match_all('#需要匹配的内容#isU', $contents1, $matches1);
        preg_match_all('#<span class="point-title">(.*)</span>#isU',$matches1[0][0],$matches2);
        preg_match_all('#<span class="point-index">(.*)</span>#isU',$matches1[0][0],$matches3);
        /*填充数组了*/
        $data=array();
        for ($x=1; $x<11; $x++) {
            $data[$x]['content']=$matches2[1][$x];
            $data[$x]['num']=$matches3[1][$x];
        }
        $data=json_encode($data,true);
        return $data;
    }


    /**
     *  source===>电影
     * 'content' => string '关键词'
     * 'num' => string '搜索指数'
     */
    public function moviesHotNews(){
        $url = 'http://tuijian.hao123.com/?type=hotrank';
        $contents1 = file_get_contents("compress.zlib://".$url);   //规避中文乱码的现象
        preg_match_all('#<h2 class="title">电影</h2>(.*)<div class="top top-blue" monkey="dsj">#isU', $contents1, $matches1);  //preg_match_all('#需要匹配的内容#isU', $contents1, $matches1);
        preg_match_all('#<span class="point-title">(.*)</span>#isU',$matches1[0][0],$matches2);
        preg_match_all('#<span class="point-index">(.*)</span>#isU',$matches1[0][0],$matches3);
        /*填充数组了*/
        $data=array();
        for ($x=1; $x<11; $x++) {
            $data[$x]['content']=$matches2[1][$x];
            $data[$x]['num']=$matches3[1][$x];
        }
        $data=json_encode($data,true);
        return $data;
    }


    /**
     *  source===>电视剧
     * 'content' => string '关键词'
     * 'num' => string '搜索指数'
     */
    public function tvPlay(){
        $url = 'http://tuijian.hao123.com/?type=hotrank';
        $contents1 = file_get_contents("compress.zlib://".$url);   //规避中文乱码的现象
        preg_match_all('#<h2 class="title">电视剧</h2>(.*)<div class="top top-yellow" monkey="zy">#isU', $contents1, $matches1);  //preg_match_all('#需要匹配的内容#isU', $contents1, $matches1);
        preg_match_all('#<span class="point-title">(.*)</span>#isU',$matches1[0][0],$matches2);
        preg_match_all('#<span class="point-index">(.*)</span>#isU',$matches1[0][0],$matches3);
        /*填充数组了*/
        $data=array();
        for ($x=1; $x<11; $x++) {
            $data[$x]['content']=$matches2[1][$x];
            $data[$x]['num']=$matches3[1][$x];
        }
        $data=json_encode($data,true);
        return $data;
    }

    /**
     *  source===>综艺
     * 'content' => string '关键词'
     * 'num' => string '搜索指数'
     */
    public function Variety(){
        $url = 'http://tuijian.hao123.com/?type=hotrank';
        $contents1 = file_get_contents("compress.zlib://".$url);   //规避中文乱码的现象
        preg_match_all('#<h2 class="title">综艺</h2>(.*)<a href="http://www.hao123.com/feedback" target="_blank">意见反馈</a>#isU', $contents1, $matches1);  //preg_match_all('#需要匹配的内容#isU', $contents1, $matches1);
        preg_match_all('#<span class="point-title">(.*)</span>#isU',$matches1[0][0],$matches2);
        preg_match_all('#<span class="point-index">(.*)</span>#isU',$matches1[0][0],$matches3);
        /*填充数组了*/
        $data=array();
        for ($x=1; $x<11; $x++) {
            $data[$x]['content']=$matches2[1][$x];
            $data[$x]['num']=$matches3[1][$x];
        }
        $data=json_encode($data,true);
        return $data;
    }


    /**
     *  source===>每日一句经典
     */
    public function dailySentence(){
        $url = 'http://baijiahao.baidu.com/s?id=1600133461613758118&wfr=spider&for=pc';
        $contents1 = file_get_contents("compress.zlib://".$url);   //规避中文乱码的现象
        preg_match_all('#转载自百家号作者：唯美志</span></span></p><p>(.*)<p><span class="bjh-p"><span class="bjh-br"></span></span></p><p><span class="bjh-p">如果你看到了这里#isU', $contents1, $matches1);  //preg_match_all('#需要匹配的内容#isU', $contents1, $matches1);
        preg_match_all('#<p><span class="bjh-p"><span class="bjh-br"></span></span></p><p><span class="bjh-p">(.*)</span></p>#isU',$matches1[0][0],$matches2);
        /*填充数组了*/
        $data=array();
        $retdata=array();
        for ($x=0; $x<363; $x++) {
            $dataonly=$matches2[1][$x];
            $string_arr2 = explode("、", $dataonly );
            array_push($data,$string_arr2[1]);
        }
        $len=count($data)-1;
        $num=rand (0,$len);
        $retdata['content']=$data[$num];
        $datayes=json_encode($retdata,true);
        return $datayes;
    }

    /*IP输出*/
    public function ipoutput(){
        vendor('ip.Ip');
        $ip=new \vendor\ip\Ip;
        $datdata=array();
        $perip=Request::instance()->ip();
        $data=$ip->getlocation($perip);
        if (Request::instance()->isPost()){
            $secach=addslashes(input("post.search"));
            $data=$ip->getlocation($secach);
            if(!filter_var($secach, FILTER_VALIDATE_IP)) {// 非法IP
                $datdata['statu']=false;
                $datdata['msg']="非法IP传值";
            }else{
                $datdata['statu']='success';
                $datdata['data']=$data;
            }
        }else{
            $datdata['statu']='success';
            $datdata['data']=$data;
        }
        return json_encode($datdata);
    }

    /*TODD*/
    /*二维码、图片、用户名、新闻、笑话、天气*/
    /*https://www.juhe.cn/docs/index/page/1*/

    /**
     * 生成二维码
     * @param  string  $url  url连接
     * @param  integer $size 尺寸 纯数字
     */
    function qrcode(){
        $value=addslashes(input("post.test"));   //二维码内容
        if(!$value){
           $value="欢迎你，小宝贝！";
        }
        Vendor('phpqrcode.phpqrcode');
        $object = new \QRcode();
        ob_end_clean();  /*这里是清空缓存一下*/
        $errorCorrectionLevel = 'L';    //容错级别
        $matrixPointSize = 5;           //生成图片大小
        //生成二维码图片
        $object->png($value,false,$errorCorrectionLevel, $matrixPointSize, 2);
        // 如果没有http 则添加
        /*if (strpos($url, 'http')===false) {
            $url='http://'.$url;
        }
        QRcode::png($url,false,QR_ECLEVEL_L,$size,2,false,0xFFFFFF,0x000000);*/
    }



    /**
     * 通过CURL发送HTTP请求
     * @param string $url  //请求URL
     * @param array $postFields //请求参数
     * @return mixed
     *
     */
    public function curlPost($url,$postFields){
        $postFields = json_encode($postFields);
        $ch = curl_init ();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8'   //json版本需要填写  Content-Type: application/json;
            )
        );
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt( $ch, CURLOPT_TIMEOUT,60);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);

        $ret = curl_exec ( $ch );
        if (false == $ret) {
            $result = curl_error(  $ch);
        } else {
            $rsp = curl_getinfo( $ch, CURLINFO_HTTP_CODE);
            if (200 != $rsp) {
                $result = "请求状态 ". $rsp . " " . curl_error($ch);
            } else {
                $result = $ret;
            }
        }
        curl_close ( $ch );
        return $result;
    }


    public function getdata(){
        $data=array();
        $data['ordertest']="1231asdsaddas23";
        $result = $this->curlPost( "http://api.16820.com/Newpay/phpinfo", $data);
        echo $result;
    }

}
