<?php

namespace common\widgets;

use common\models\WidgetText;
use yii\base\Widget;
use Yii;

/**
 * Class DbText
 * Return a text block content stored in db
 * @package common\widgets\text
 */
class DbText extends Widget
{
    /**
     * @var string text block key
     */
    public $key;

        /**
     * @var string text block key
     */
    public $domain_id;

    /**
     * @return string
     */
    public function run()
    {
        $cacheKey = [
            WidgetText::className(),
            $this->key,
            $this->domain_id
        ];
        $content = Yii::$app->cache->get($cacheKey);
        if (!$content) {
            $models =  WidgetText::findAll(['key' => $this->key, 'status' => WidgetText::STATUS_ACTIVE, 'domain_id' => $this->domain_id]);

            if (!$models) {
                //try find en-us locale
                $pos =  strrpos($this->key,'.');
                $base = substr($this->key, 0, $pos);
                $this->key = $base . '.' . Yii::$app->sourceLanguage;
                $models =  WidgetText::findAll(['key' => $this->key, 'status' => WidgetText::STATUS_ACTIVE]);
            }
            if ($models) {
                $content = '';

                foreach ($models as $model) {
                    $content .= $model->body;
                }
                
                Yii::$app->cache->set($cacheKey, $content, 60*60*24);
            }
        }
        return $content;
    }
}
