<?php

namespace api\models\schema\base;
use \Yii;

/**
 * Description of Base
 *
 * @author Eugene Fabrikov <eugene.fabrikov@gmail.com>
 */
class RootBase
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            "type"   => "array",
            "title"  => Yii::t('backend', 'Body'),
            "format" => "tabs",
            "items"  => [
                "title"          => Yii::t('backend', 'Widgets'),
                "id"             => "widget",
                "headerTemplate" => "{{i1}} - {{self.tab_title}}",
            ],
        ];

        //text
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\text\PromoTitle())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\text\PromoSubtitle())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\text\IntroText())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\text\SmallText())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\text\SectionText())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\text\HiddenBlock())->getData();
        
        //editor
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\editor\SCEditor())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\editor\PromoWysiwyg())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\editor\Wysiwyg())->getData();
        //image
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\image\Gallery())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\image\SimplePhoto())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\image\AddImage())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\image\ImageSliderRevolution())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\image\Intro())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\image\Banner())->getData();

        //video
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\video\Video())->getData();
        //arrays\objects
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\objects\PromoSlider())->getData();        
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\objects\Engine())->getData();        
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\objects\FeatBox())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\objects\VehiclePromotions())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\objects\Files())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\objects\Characteristics())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\objects\Iframes())->getData();
        //arrays\tables
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\tables\InfoMenu())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\tables\Anchor())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\tables\Credit())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\tables\DealerQB())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\tables\Breadcrumbs())->getData();

        //block\page
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\News())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\Promos())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\FindADealer())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\CorporateSales())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\Contact())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\ContactForm())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\Financing())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\Models())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\BookATestDriveForm())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\Service())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\page\Subscribes())->getData();
        //block
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\BlogListTop())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\BlogListBottom())->getData();

        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\Social())->getData();
        //block part
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\part\ArticlesPart())->getData();

        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\IWantTo())->getData();
    }

    public function getData()
    {
        return $this->data;
    }
}
