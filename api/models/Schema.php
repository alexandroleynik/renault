<?php

namespace api\models;

use yii\helpers\Url;
use \Yii;

/**
 * @author Eugene Fabrikov <eugene.fabrikov@eugene.fabrikov@gmail.com>
 */
class Schema extends \yii\base\Model
{

    public static function find($id)
    {
        $id = strip_tags(stripcslashes($id));

        $arr = explode('-', $id);

        $path = '\\api\\models\\schema\\root\\' . $arr[0] . '\\' . $arr[1] . '\\Schema';

        $model = new $path();

        return $model->getData();
    }

    public static function filter($model)
    {   
        if ((Yii::$app->request->get('domain_id') > 0 ) and  isset($model['items'])) {
            $wBlackList = Yii::$app->keyStorage->get('backend.widgets.dealer.blacklist');
            $wBlackList = explode(',', $wBlackList);

            $model = self::filterWidgets($model, $wBlackList);
        }

        return $model;
    }

    private static function filterWidgets($model, $widgetIDs)
    {
        $result                   = $model;
        $result['items']['oneOf'] = [];

        foreach ($model['items']['oneOf'] as $key => $value) {
            $wId = $value['properties']['tab_title']['watch']['title'];
            preg_match('/___(.+)___/', $wId, $matches);
            $wId = $matches[1];

            if (in_array($wId, $widgetIDs)) {
                continue;
            }

            $result['items']['oneOf'][] = $value;
        }

        return $result;
    }
}