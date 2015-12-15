<?php

namespace api\models;



/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Corporate extends \common\models\Corporate
{
    public function fields()
    {
        return [
            'id',
            'firstname',
            'secondname',
            'lastname',
            'email',
            'myemail',
            'message',
            'domain_id',
            'phone',
            'status'];

    }





}
