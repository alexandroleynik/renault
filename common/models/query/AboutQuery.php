<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\About;
use yii\db\ActiveQuery;

class AboutQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%about}}.status' => About::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%about}}.published_at', time()]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{about_categories}}', '{{about_categories}}.about_id = {{%about}}.id');
            $this->andWhere('{{about_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%about.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }
}