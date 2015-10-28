<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Model;
use yii\db\ActiveQuery;

class ModelQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%model}}.status' => Model::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%model}}.published_at', time()]);
        $this->orderBy('{{%model}}.weight');
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{model_categories}}', '{{model_categories}}.model_id = {{%model}}.id');
            $this->andWhere('{{model_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%model.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

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