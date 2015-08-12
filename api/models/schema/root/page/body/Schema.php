<?php

namespace api\models\schema\root\page\body;

class Schema
{
    private $data = [];

    public function getData()
    {
        $this->data = [
            "type"   => "array",
            "title"  => "Body",
            "format" => "tabs",
            "items"  => [
                "title"          => "Widgets",
                "id"             => "widget",
                "headerTemplate" => "{{i1}} - {{self.tab_title}}",
            ],            
        ];

        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\News())->getData();
        /* "oneOf"          => [
          [
          "$ref"  => "/js/json-editor/schema/add-image.json",
          "title" => "Add image"
          ],
          [
          "$ref"  => "/js/json-editor/schema/wysiwyg.json",
          "title" => "Wysiwyg editor"
          ],
          [
          "$ref"  => "/js/json-editor/schema/book-a-test-drive-form.json",
          "title" => "Book a test drive form"
          ],
          [
          "$ref"  => "/js/json-editor/schema/image-slider-revolution.json",
          "title" => "Image slider revolution"
          ],
          [
          "$ref"  => "/js/json-editor/schema/vehicle-promotions.json",
          "title" => "Vehicle promotions"
          ],
          [
          "$ref"  => "/js/json-editor/schema/articles-part.json",
          "title" => "News part"
          ],
          [
          "$ref"  => "/js/json-editor/schema/i-want-to.json",
          "title" => "I want to"
          ],
          [
          "$ref"  => "/js/json-editor/schema/social.json",
          "title" => "Social"
          ],
          [
          "$ref"  => "/js/json-editor/schema/news.json",
          "title" => "News"
          ],
          [
          "$ref"  => "/js/json-editor/schema/promos.json",
          "title" => "Promos"
          ],
          [
          "$ref"  => "/js/json-editor/schema/find-a-dealer.json",
          "title" => "Find a dealer"
          ],
          [
          "$ref"  => "/js/json-editor/schema/contact.json",
          "title" => "contact"
          ]
          ] */


        return $this->data;
    }
}