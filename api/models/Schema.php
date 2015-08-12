<?php

namespace api\models;

use yii\helpers\Url;

/**
 * @author Eugene Fabrikov <eugene.fabrikov@eugene.fabrikov@gmail.com>
 */
class Schema extends \yii\base\Model
{
    public static function find($id) {        
        $id = strip_tags(stripcslashes($id));

        $arr = explode('-', $id);

        $path = '\api\\models\\schema\\root\\' . $arr[0] . '\\body\\Schema';

        $model = new $path();
        
        return $model->getData();
    }

}
