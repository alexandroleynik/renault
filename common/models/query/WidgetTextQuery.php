<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\WidgetText;
use yii\db\ActiveQuery;

class WidgetTextQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%widget_text}}.status' => WidgetText::STATUS_ACTIVE]);
        $this->andWhere(['<', '{{%widget_text}}.created_at', time()]);
        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{widget_text.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }

    public function customCode()
    {
        $this->andWhere('{{widget_text.key}} IN ("frontend.code.head.end","frontend.code.body.end")');

        return $this;
    }
}