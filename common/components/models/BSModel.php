<?php

namespace common\components\models;

use yii;
use common\components\helper\BSHelper;

/**
 * BSModel.php file
 * 基模型
 * User: LiuRan
 * Date: 2016/5/6 0006
 * Time: 下午 12:50
 */
class BSModel extends \yii\db\ActiveRecord
{
    public function init()
    {
        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'onSaveHandler'], TRUE);
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'onSaveHandler'], FALSE);
    }

    /**
     * 处理 add_time add_ip update_time update_id
     * @param $handler bool
     * @return bool
     */
    public function onSaveHandler($handler)
    {
        if ($handler->isValid)
        {
            $ip = BSHelper::getIp();

            if ($handler->sender->isNewRecord &&
                $handler->sender->hasAttribute('add_time') &&
                $handler->sender->hasAttribute('add_ip')
            )
            {
                $this->add_time = $this->add_time > 0 ? $this->add_time : time();
                $this->add_ip = !empty($this->add_ip) ? $this->add_ip : (!empty($ip) ? $ip : '');
            }
            else if ($handler->sender->hasAttribute('update_time') && $handler->sender->hasAttribute('update_ip'))
            {
                $this->update_time = time();
                $this->update_ip = !empty($ip) ? $ip : '';
            }

            return TRUE;
        }

        return FALSE;
    }
}
