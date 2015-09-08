<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Block;
use yii\db\ActiveQuery;

class BlockQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%block}}.status' => Block::STATUS_PUBLISHED]);
        return $this;
    }

    public function ignore($ids)
    {
        $this->andWhere('{{%block}}.id NOT IN (' . $ids . ')');

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%block.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }
}