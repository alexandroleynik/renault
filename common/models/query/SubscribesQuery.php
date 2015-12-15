<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Subscribes;
use yii\db\ActiveQuery;

class SubscribesQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%subscribe_form}}.status' => Subscribes::STATUS_PUBLISHED]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function ignore($ids)
    {
        $this->andWhere('{{%subscribe_form}}.id NOT IN (' . $ids . ')');

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%subscribe_form.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }


}