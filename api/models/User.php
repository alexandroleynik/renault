<?php

namespace api\models;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class User extends \common\models\User
{

    public function fields()
    {
        return ['id', 'username', 'created_at', 'domain_id'];
    }

    public function extraFields()
    {
        return ['userProfile'];
    }
}