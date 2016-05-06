<?php

namespace common\components\helper;

use Yii;
use yii\helpers\Html;

/**
 * BSHelper.php file
 * User: LiuRan
 * Date: 2016/5/6 0006
 * Time: 下午 12:53
 */

class BSHelper
{
    /**
     * 获取HOST
     * @return null
     */
    public static function getHostName()
    {
        $urlInfo = parse_url(Yii::$app->request->hostInfo);

        return isset($urlInfo['host']) ? $urlInfo['host'] : NULL;
    }

    /**
     * 获得客户端IP地址
     * @return string|NULL
     */
    public static function getIp()
    {
        $tmp = array ('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED'
        , 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED'
        , 'HTTP_X_REAL_IP', 'REMOTE_ADDR');

        foreach ($tmp as $key)
        {
            if (isset($_SERVER[$key]))
            {
                foreach (explode(',', $_SERVER[$key]) as $ip)
                {
                    $ip = trim($ip);

                    if (filter_var($ip, FILTER_VALIDATE_IP) !== FALSE)
                    {
                        return $ip;
                    }
                }
            }
        }

        return NULL;
    }

    /**
     * 截取字符串
     * @param $string
     * @param $length
     * @param bool|FALSE $append
     * @return array|string
     */
    public static function subString($string, $length, $append = TRUE)
    {
        $string = htmlspecialchars_decode($string);

        if (strlen($string) <= $length)
        {
            return self::filterDataXSS($string);
        }

        $i = 0;
        $stringLast = [];

        while ($i < $length)
        {
            $stringTMP = substr($string, $i, 1);

            if (ord($stringTMP) >= 224)
            {
                $stringTMP = substr($string, $i, 3);
                $i = $i + 3;
            }
            elseif (ord($stringTMP) >= 192)
            {
                $stringTMP = substr($string, $i, 2);
                $i = $i + 2;
            }
            else
            {
                $i = $i + 1;
            }

            $stringLast[] = $stringTMP;
        }

        $stringLast = implode("", $stringLast);

        if ($append)
        {
            $stringLast .= "...";
        }

        return htmlspecialchars($stringLast);
    }

    /**
     * 隐藏字符串的一部分 用*代替
     * @param $str
     * @param int $leftLength 左边保留长度
     * @param int $rightLength 右边保留长度
     * @param string $replaceChar 替换成的字符串
     * @return string
     */
    public static function replaceStr($str, $leftLength = 3, $rightLength = 3, $replaceChar = '*')
    {
        $strLength = strlen($str);

        if ($leftLength >= $strLength)
        {
            return str_repeat($replaceChar, $strLength);
        }
        else if ($rightLength >= $strLength)
        {
            return str_repeat($replaceChar, $strLength);
        }
        if (($leftLength + $rightLength) >= $strLength)
        {
            return str_repeat($replaceChar, $strLength);
        }
        else
        {
            $leftStr = substr($str, 0, $leftLength);
            $rightStr = substr($str, ($strLength - $rightLength), $rightLength);
            $middleStr = substr($str, ($leftLength), ($strLength - ($rightLength + $leftLength)));

            return $leftStr . str_repeat($replaceChar, strlen($middleStr)) . $rightStr;
        }

        return $str;
    }

    /**
     * 获取来路域名，如果不是根域，则跳转到根域首页
     * @param int $projectFlag 0、referrer地址 1、商城首页 2、卖家中心首页 3、用户中心首页
     * @return string
     */
    public static function getReferrer($projectFlag = 1)
    {
        $referrer = Yii::$app->request->getReferrer();
        $rootDomain = Yii::$app->params['rootDomain'];
        $returnUrl = '';

        if ($projectFlag > 0)
        {
            switch ($projectFlag)
            {
                case 1:
                    $returnUrl = Yii::$app->params['emcShopUrl'];
                    break;
                case 2:
                    $returnUrl = Yii::$app->params['emcSellerUrl'];
                    break;
                case 3:
                    $returnUrl = Yii::$app->params['emcMemberUrl'];
                    break;
            }
        }

        if (!is_null($referrer) && strpos($referrer, $rootDomain) !== FALSE)
        {
            $returnUrl = $referrer;
        }

        if (strpos($referrer, Yii::$app->params['emcLoginUrl']) !== FALSE)
        {
            $returnUrl = Yii::$app->params['emcShopUrl'];
        }

        return $returnUrl;
    }

    /**
     * 处理数据的XSS攻击
     * @param array|string $data
     * @param string $key
     * @return array|string
     */
    public static function filterDataXSS($data, $key = '')
    {
        if (is_array($data))
        {
            if (count($data) == 0)
            {
                return [];
            }

            if (!empty($key))
            {
                isset($data[$key]) && $data[$key] = Html::encode(Html::decode($data[$key]));
            }
            else
            {
                foreach ($data as $key => $value)
                {
                    if (is_array($value) && count($value) > 0)
                    {
                        foreach ($value as $k => $v)
                        {
                            $data[$key][$k] = Html::encode(Html::decode($v));
                        }
                    }
                    else
                    {
                        $data[$key] = Html::encode(Html::decode($value));
                    }
                }
            }

            return $data;
        }

        return Html::encode(Html::decode($data));
    }

    /**
     * 保存登录状态
     * @param $name
     * @param $value
     * @param int $expire
     * @param string $domain
     * @return bool
     */
    public static function setCookie($name, $value, $expire = 0, $domain = '')
    {
        $flag = TRUE;    // 添加结果标识

        try
        {
            if (!is_null($expire))
            {
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => $name,
                    'value' => EMHelper::encrypt($value),
                    'expire' => $expire == 0 ? Yii::$app->params['cookieExpireTime'] : $expire,
                    'domain' => $domain,
                    'path' => '/'
                ]));
            }
            else
            {
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => $name,
                    'value' => EMHelper::encrypt($value),
                    'domain' => $domain,
                    'path' => '/'
                ]));
            }
        }
        catch (\common\components\exception\EMException $e)
        {
            $flag = FALSE;
            Yii::error($e->getMessage());
        }

        return $flag;
    }

    /**
     * 获取登录状态
     * @param $name
     * @param bool|FALSE $isJsonDecode
     * @return mixed|null|string
     */
    public static function getCookie($name, $isJsonDecode = FALSE)
    {
        $cookies = Yii::$app->request->cookies;

        if ($cookies->has($name))
        {
            if ($isJsonDecode)
            {
                return json_decode(EMHelper::decrypt($cookies->get($name)->value), TRUE);
            }

            return EMHelper::decrypt($cookies->get($name)->value);
        }

        return NULL;
    }
}