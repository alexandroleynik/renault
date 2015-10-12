<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\block;

use api\models\schema\base\Base;
use \Yii;

class IWantTo extends Base
{
    protected $wid    = 'i-want-to';
    protected $wtitle = 'I want to';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['i_want_to_text']             = [
            'type'    => 'string',
            'title' => Yii::t('backend', 'I want to text'),
            'default' => 'Я хотiв би',
        ];
        $this->data['properties']['book_a_test_drive_text']     = [
            'type'    => 'string',
            'title' => Yii::t('backend', 'Book a test drive text'),
            'default' => 'записатися<br> на тест-драйв',
        ];
        $this->data['properties']['twoPartUrlToBookATestDrive'] = [
            'type'    => 'string',
            'title' => Yii::t('backend', 'link Book a test drive text'),
            'default' => '/page/view/book-a-test-drive',
        ];
        $this->data['properties']['load_booking_text']          = [
            'type'    => 'string',
            'title' => Yii::t('backend', 'Load booking text'),
            'default' => 'завантажити<br> брошуру',
        ];
        $this->data['properties']['twoPartUrlToLoadBooking']    = [
            'type'    => 'string',
            'title' => Yii::t('backend', 'link Load booking text'),
            'default' => 'http://servicebooking.renault.co.uk',
        ];
        $this->data['properties']['load_price_list']            = [
            'type'    => 'string',
            'title' => Yii::t('backend', 'Load price list'),
            'default' => 'завантажити<br> прайс-лист',
        ];
        $this->data['properties']['twoPartUrlToBrochures']      = [
            'type'    => 'string',
            'title' => Yii::t('backend', 'link Load price list'),
            'default' => '/page/view/brochures',
        ];
        $this->data['properties']['contact_with_dealer_text']   = [
            'type'    => 'string',
            'title' => Yii::t('backend', 'find a dealer'),
            'default' => 'звязатися з<br>диллером',
        ];
        $this->data['properties']['twoPartUrlToFindADealer']    = [
            'type'    => 'string',
            'title' => Yii::t('backend', 'link to find a dealer'),
            'default' => '/page/view/contact-form',
        ];


        return $this->data;
    }
}