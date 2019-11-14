<?php

namespace mangdin\TrustSec;

use GuzzleHttp\Client;
use think\facade\Cache;

/**
 * 客户端类，封装了TrustSec学生机开放平台Api的操作
 *
 * 具体的接口规则可参考官方文档：http://www.ts10000.net/mobile 手机端
 *
 * @package mangdin\TrustSecClient
 */
class TrustSecClient
{
    /**
     * 用户ID
     * @var string
     */
    private $LoginName;

    /**
     * 密码
     * @var string
     */
    private $PassWord;

    /**
     * 接口入口网址
     */
    const API_ENDPOINT = 'http://www.ts10000.net/mobile';

    /**
     * TrustSecClient constructor.
     * @param $LoginName 用户ID
     * @param $PassWord 密码
     * @param $Key  密钥key
     * @throws \Exception
     */
    public function __construct($LoginName, $PassWord)
    {
        $LoginName = trim($LoginName);
        $PassWord = trim($PassWord);

        if (empty($LoginName)) {
            throw new \Exception('login name is empty');
        }

        if (empty($PassWord)) {
            throw new \Exception('login password is empty');
        }

        $this->LoginName = $LoginName;
        $this->PassWord = $PassWord;
    }

    /**
     * 获取设备列表
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function getDeviceList()
    {
        $params = [
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
        ];
        return $this->post(self::API_ENDPOINT . '/terminal_lists', $params);
    }

    /**
     * @param $name 设备名称
     * @param $number 设备手机号
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function addDevice($name, $number)
    {
        $params = [
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
            'name' => $name,
            'number' => $number,
        ];
        return $this->post(self::API_ENDPOINT . '/terminal_add', $params);
    }

    /**
     *  获取设备实时信息详情
     * @param $tid 设备id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function getDeviceDetial($tid){
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
        ];
        return $this->post(self::API_ENDPOINT . '/terminal_info', $params);
    }

    /**
     * 修改设备信息
     * @param $tid 设备ID
     * @param $name 设备名称
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function updateDeviceInfo($tid,$name){
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
            'name' => $name,
        ];
        return $this->post(self::API_ENDPOINT . '/terminal_edit', $params);
    }

    /**
     *  查看上课时间段
     * @param $tid 设备ID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function getClassTime($tid){
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
        ];
        return $this->post(self::API_ENDPOINT . '/disturb_lists', $params);
    }

    /**
     * 设置上课时间段
     * @param $tid 设备ID
     * @param $stime 开始时间 如：06:00
     * @param $etime 结束时间 如：12:00
     * @param $week 周几，天 如：123456 表示周一至周六
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function setClassTime($tid, $stime, $etime, $week){
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
            'stime' => $stime,
            'etime' => $etime,
            'week' => $week,
        ];
        return $this->post(self::API_ENDPOINT . '/disturb_add', $params);
    }

    /**
     * 删除上课时间段
     * @param $tid 设备ID
     * @param $delId 时间段ID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function delClassTime($tid, $delId)
    {
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
            'id' => $delId,
        ];
        return $this->post(self::API_ENDPOINT . '/disturb_del', $params);
    }

    /**
     * 获取设备亲情号码集合
     * @param $tid 设备ID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function getPhoneConfig($tid)
    {
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
        ];
        return $this->post(self::API_ENDPOINT . '/terminal_key', $params);
    }

    /**
     * 修改设备亲情号码
     * @param $tid 设备ID
     * @param $PhoneNumber 亲情号码集合,最多四个，用英文 , 分割，如13812341234,13812341235
     * @param $SosNumber SOS号码 单个号码
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function setPhoneNumber($tid,$PhoneNumber,$SosNumber){
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
            'keynum' => $PhoneNumber,
            'keysos' => $SosNumber,
        ];
        return $this->post(self::API_ENDPOINT . '/terminal_key_set', $params);
    }

    /**
     *  定位获取时间段 列表
     * @param $tid 设备ID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function locReportList($tid)
    {
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
        ];
        return $this->post(self::API_ENDPOINT . '/locreport_lists', $params);
    }

    /**
     * 设置定位获取时间段
     * @param $tid 设备ID
     * @param $stime 开始时间 如：06:00
     * @param $etime 结束时间 如：12:00
     * @param $week 周几，天 如：123456 表示周一至周六
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function setLocReport($tid,$stime,$etime,$week)
    {
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
            'stime' => $stime,
            'etime' => $etime,
            'week' => $week,
            'itime'=> 15,    //时间间隔
        ];
        return $this->post(self::API_ENDPOINT . '/locreport_add', $params);
    }

    /**
     * 删除定位获取时间段
     * @param $tid 设备ID
     * @param $delId 时间段ID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function delLocReport($tid, $delId)
    {
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
            'id' => $delId,
        ];
        return $this->post(self::API_ENDPOINT . '/locreport_del', $params);
    }

    /**
     * 设备激活同步
     * @param $tid 设备ID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    public function activePhone($tid)
    {
        $params = [
            'tid' => $tid,
            'uid' => $this->LoginName,
            'pwd' => $this->PassWord,
        ];
        return $this->post(self::API_ENDPOINT . '/terminal_active', $params);
    }

    /**
     * 接口post请求
     *
     * @param $url
     * @param array $params
     * @param bool $auth
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \think\Exception
     */
    private function post($url, $params = [])
    {
        $client = new Client();
        $response = $client->request('GET',$url, ['query'=>$params]);
        $result = json_decode($response->getBody(), true);
        return $result;
        /*if ($result['status'] === 0){
            return $result;
        }else{
            throw new \Exception($result['msg']);
        }*/
    }

}