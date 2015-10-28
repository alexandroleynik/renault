<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\ServicePage;
use yii\db\ActiveQuery;

class ServicePageQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%service_page}}.status' => ServicePage::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%service_page}}.published_at', time()]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{service_page_categories}}', '{{service_page_categories}}.service_page_id = {{%service_page}}.id');
            $this->andWhere('{{service_page_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function firstServicePage($mid)
    {
        if (!empty($mid)) {
            $this->andWhere('{{service_page.model_id}} = "' . $mid . '"');
            $this->orderBy('{{service_page.weight}}');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%service_page.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

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