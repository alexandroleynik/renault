<?php
/**
 * Created by PhpStorm.
 * User: viktor

 */
namespace common\components\excell;
use yii\base\Widget;
class ImportFileWidget extends Widget {
    public $model;
    public $form;
    public $label = null;
    public $options = [];

    public function run(){
        return $this->form
            ->field($this->model, ImportBehavior::XLS_FILE )
            ->label( $this->label )
            ->fileInput( $this->options );
    }
}