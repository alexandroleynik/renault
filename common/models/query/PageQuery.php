<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Page;
use yii\db\ActiveQuery;

class PageQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%page}}.status' => Page::STATUS_PUBLISHED]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function ignore($ids)
    {
        $this->andWhere('{{%page}}.id NOT IN (' . $ids . ')');

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%page.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }

    public function localeGroupPages($model)
    {
        $this->multiple = true;        
        $this->select(['id', 'slug', 'title', 'locale']);
        $this->published();
        $this->andWhere($model->tableName() . '.domain_id = "' . $model->domain_id . '"');
        $this->andWhere($model->tableName() . '.locale_group_id = "' . $model->locale_group_id . '"');
        
        return $this;
    }
}