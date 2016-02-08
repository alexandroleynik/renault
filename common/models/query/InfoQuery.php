<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Info;
use yii\db\ActiveQuery;

class InfoQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%info}}.status' => Info::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%info}}.published_at', time()]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{info_categories}}', '{{info_categories}}.info_id = {{%info}}.id');
            $this->andWhere('{{info_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

        /**
     *
     * @return $this
     */
    public function onlyModelCategory($ids)
    {        
        if (!empty($ids)) {            
            $this->leftJoin('{{model}}', '{{model}}.id = {{%info}}.model_id');
            $this->leftJoin('{{model_categories}}', '{{model_categories}}.model_id = {{%model}}.id');
            $this->andWhere('{{model_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    /**
     * @param $mid - Model ID
     * @param $did - Domain ID
     * @return $this
     */
    public function firstInfo($mid, $did = null)
    {
        if (!empty($mid)) {
            $this->andWhere('{{info.model_id}} = "' . $mid . '"');
            if($did !== null) {
                $this->andWhere('({{info.domain_id}} = "' . $did . '") OR {{info.domain_id}} = "0"');
            }

            $this->orderBy('{{info.weight}}');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%info.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

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