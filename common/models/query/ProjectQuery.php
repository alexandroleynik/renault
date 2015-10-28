<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Project;
use yii\db\ActiveQuery;

class ProjectQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%project}}.status' => Project::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%project}}.published_at', time()]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{project_categories}}', '{{project_categories}}.project_id = {{%project}}.id');
            $this->andWhere('{{project_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%project.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

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