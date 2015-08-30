<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\block\bloglist;


use api\models\schema\base\Base;
class BlogListTop extends Base{
    protected $wid = 'bloglist-top';
    protected $wtitle = 'BlogListTop';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["title"] = [

            "type" => "string",
            "title" => "header",
            "default" => "ЮРИДИЧЕСКАЯ ИНФОРМАЦИЯ"
        ];

        $this->data['properties']["text"] = [
            "type" => "string",
            "title" => "text",
            "default" => '** Ставка страхования КАСКО по программе «Разумное КАСКО» (далее - Программа) рассчитывается как 3,5% в год от стоимости автомобиля и действительна при условии приобретения новых автомобилей в салонах официальных дилеров. Страхование рисков Хищения и Ущерба (при полной конструктивной или физической гибели) не должно превышать действительную стоимость застрахованного имущества, страхование рисков повреждения автомобиля при ДТП с двумя и более транспортными средствами, произошедшими в результате нарушения Правил дорожного движения застрахованным лицом, послужившим причиной ДТП (Ущерб) – 1 раз в течение срока действия договора страхования. Максимальная страховая сумма по риску Ущерб при повреждении автомобиля при ДТП с двумя и более транспортными средствами, произошедшими в результате нарушения Правил дорожного движения застрахованным лицом, послужившим причиной ДТП составляет: 35 тыс. рублей при ремонте у официального дилера Renault по направлению Страховщика или 15 тыс. рублей, при ремонте на авторизованной СТОА. Страховая компания ООО «Росгосстрах» (лицензия С № 097750 от 07.12.2009), www.RGS.ru . Не является публичной офертой. Реклама.Программа Renault Credit реализуется при участии АО "РН Банк". Подробная информация по тел. 8(800) 200-80-80.'
        ];


        return $this->data;
    }
}