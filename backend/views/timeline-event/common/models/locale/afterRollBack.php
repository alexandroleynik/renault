<?php
/**
 * @author Eugene Fabrikov <eugene.fabrikov@gmail.com>
 * @var $model common\models\TimelineEvent
 */
date_default_timezone_set('Europe/London');
?>

<div class="timeline-item">
    <span class="time">
        <i class="fa fa-clock-o"></i>
        <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>
    <div class="timeline-body">
        <?php echo Yii::t('backend', 'User') ?>
        <b><?php echo \common\models\User::findOne(['id' => $model->data['uid']])->username; ?></b>
        <?php echo Yii::t('backend', 'roll back') ?>
        <b><?php echo preg_replace('/common\\\models\\\locale\\\/', '', $model->category) ?></b>
        #<b><?php echo $model->data['attributes']['id'] ?></b>,
        slug: <b><?php echo $model->data['attributes']['slug'] ?></b>,
        title: <b><?php echo $model->data['attributes']['title'] ?></b>
        (<u><?php echo \yii\helpers\Html::a(
            Yii::t('backend', 'Roll back to this date'),
            $rollBackUrl

        ) ?> </u>)
    </div>


</div>