<?php

namespace common\components\filesystem;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class FileLogic
 * @package common\components\filesystem
 */
class FileLogic extends Component
{

    public static function getModifiedTime($files = [])
    {
        $result = [];
        
        foreach ($files as $value) {

            //\yii\helpers\VarDumper::dump(explode(Yii::getAlias('@webroot'), $value), 11, 1);
            $key = str_replace('\\', '/', explode(Yii::getAlias('@webroot'), $value)[1]);

            $result[$key] = filemtime($value);
        }

        return $result;
        //filemtime(Yii::getAlias('@webroot/templates/.js')
    }
}