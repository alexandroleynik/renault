<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */
$js = <<<'SCRIPT'
    $(document).on('click', '#genpassword', function (e) {
        e.preventDefault();
        $(this).parent().find('input').val(Math.random().toString(36).slice(-8));
        return false;
    });
SCRIPT;
$this->registerJs($js);
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
        <?php echo $form->field($model, 'username') ?>
        <?php echo $form->field($model, 'email') ?>
        <?php echo $form->field($model, 'password', ['template' => "{label}\n{input}\n<a href='#' id='genpassword'>".Yii::t("backend", "Create pass")."</a>{hint}\n{error}"]) ?>
        <?php echo $form->field($model, 'status')->label(Yii::t('backend', 'Active'))->checkbox() ?>
        <?php echo $form->field($model, 'roles')->checkboxList($roles) ?>
        <?php echo $form->field($model, 'domain_id')->dropDownList($domains) ?>
        <div class="form-group">
            <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
