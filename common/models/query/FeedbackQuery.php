<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Feedback;
use yii\db\ActiveQuery;

class FeedbackQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%feedback_form}}.status' => Feedback::STATUS_PUBLISHED]);

        return $this;
    }

    /**
     *
     * @return $this
     */


    public function forDomain()
    {
        $this->andWhere('{{%feedback_form.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }

//    public function localeGroupPages($model)
//    {
//        $this->multiple = true;
//        $this->select(['id', 'text']);
//        $this->published();
//        $this->andWhere($model->tableName() . '.domain_id = "' . $model->domain_id . '"');
//        $this->andWhere($model->tableName() . '.locale_group_id = "' . $model->locale_group_id . '"');
//
//        return $this;
//    }
}