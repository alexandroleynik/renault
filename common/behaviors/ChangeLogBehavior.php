<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\caching\TagDependency;
use yii\db\ActiveRecord;
use common\models\TimelineEvent;

/**
 * ChangeLogBehavior automatically invalidates cache by specified keys or tags
 *  public function behaviors()
 * {
 *     return [
 *         [
 *             'class' => ChangeLogBehavior::className(),
 *             'tags' => [
 *                  'awesomeTag',
 *                   function($model){
 *                      return "tag-{$model->id}"
 *                  }
 *              ],
 *             'keys' => [
 *                  'awesomeKey',
 *                  function($model){
 *                      return "key-{$model->id}"
 *                  }
 *              ]
 *         ],
 *     ];
 * }
 * ```
 * @package common\behaviors
 */
class ChangeLogBehavior extends Behavior
{
    /**
     * @var ActiveRecord
     */
    public $owner;

    /**
     * Get events list.
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
        ];
    }

    /**
     * Invalidate cache connected to model.
     * @return bool
     */
    public function afterDelete()
    {
        if ($this->owner->locale) {
            $className = $this->owner->getLocaleInstance($this->owner->locale)->className();
        } else {
            $className = $this->owner->className();
        }

        TimelineEvent::log(
            $className, 'afterDelete', [
            'attributes' => $this->owner->getAttributes(),
            'uid'        => Yii::$app->user->identity->id
            ]
        );
        return true;
    }

    public function afterInsert()
    {
        TimelineEvent::log(
            $this->owner->className(), 'afterInsert', [
            'attributes' => $this->owner->getAttributes(),
            'uid'        => Yii::$app->user->identity->id
            ]
        );

        return true;
    }

    public function afterUpdate()
    {
        TimelineEvent::log(
            $this->owner->className(), 'afterUpdate', [
            'attributes' => $this->owner->getAttributes(),
            'uid'        => Yii::$app->user->identity->id
            ]
        );

        return true;
    }
}