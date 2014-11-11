<?php

namespace pafnow\helpers;

use Yii;

class Json extends \yii\helpers\Json
{
    public static function decode($json, $asArray = true, $isQuoted = true)
    {
        if (!$isQuoted)
            $json = "{\"" . str_replace(array(":",","), array("\":\"","\",\""), $json) . "\"}";
        return parent::decode($json, $asArray);
    }
    
    public static function getValue($json, $key, $isQuoted = true, $exReturn = null)
    {
        try {
            $values = Json::decode($json, true, $isQuoted);
            if (isset($values[$key]))
                return $values[$key];
            else
                return null;
        }
        catch (yii\base\InvalidParamException $e) { //Exception thrown by Json::decode
            return $exReturn;
        }
    }
}