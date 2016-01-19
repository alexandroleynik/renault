<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Emailf;
use yii\db\ActiveQuery;

class EmailfQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%email_for_feedback_form}}.status' => Emailf::STATUS_PUBLISHED]);

        return $this;
    }

    /**
     *
     * @return $this
     */


    public function forDomain()
    {
        $this->andWhere('{{%email_for_feedback_form.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

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