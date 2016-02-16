<?php
namespace common\config;
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 16.02.2016
 * Time: 12:50
 */
use Yii;

class Locale
{
    public static function getLocale($locale)
    {
        if($locale == 0){
            switch (Yii::getAlias('@dealerLocale')) {
                case 'uk':
                    return [
                        'uk-UA'=>'Українська',
                        'ru-RU' => 'Русский',
                    ];
                    break;
                case 'ru':
                    return [
                        'ru-RU' => 'Русский',
                        'uk-UA'=>'Українська',
                    ];
                    break;
                default:
                    return [
                        'uk-UA'=>'Українська',
                        'ru-RU' => 'Русский',
                    ];

            }
        }
        if($locale == 1){
            switch (Yii::getAlias('@dealerLocale')) {
                case 'uk':
                    return [
                        'uk-UA'=>'Українська',
                    ];
                    break;
                case 'ru':
                    return [
                        'ru-RU' => 'Русский',
                    ];
                    break;
                default:
                    return [
                        'uk-UA'=>'Українська',
                    ];
            }
        }
}
}