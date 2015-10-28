<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\AboutPage;
use yii\db\ActiveQuery;

class AboutPageQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%about_page}}.status' => AboutPage::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%about_page}}.published_at', time()]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{about_page_categories}}', '{{about_page_categories}}.about_page_id = {{%about_page}}.id');
            $this->andWhere('{{about_page_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function firstAboutPage($mid)
    {
        if (!empty($mid)) {
            $this->andWhere('{{about_page.model_id}} = "' . $mid . '"');
            $this->orderBy('{{about_page.weight}}');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%about_page.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

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