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
            $this->andWhere('{{model_categories.category_id}} = "'.$ids.'"');
        }

        return $this;
    }

}