<?php

namespace api\models;



/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Subscribes extends \common\models\Subscribes
{
    public function fields()
    {
        return [
            'id',
            'firstname',
            'secondname',
            'lastname',
            'email',
            'domain_id',
            'phone',
            'status'];

    }





}
