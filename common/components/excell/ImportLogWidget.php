<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 25.02.2016
 * Time: 12:28
 */

namespace common\components\excell;


use yii\base\Widget;
use yii\helpers\Html;

class ImportLogWidget extends Widget {
    public $model;
    public $options = [
        'class' => 'import-log'
    ];
    public function run(){

        if( $log = $this->model->getImportLog() ){

            $content = [];
            foreach($log as $msg) $content[] = Html::tag('li', $msg );
            return Html::tag('ul', implode('', $content), $this->options );
        }
        return null;
    }
}