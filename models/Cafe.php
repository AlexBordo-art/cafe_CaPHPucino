<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Cafe extends ActiveRecord
{
    public function rules()
{
    return [
        [['name', 'address', 'cuisine'], 'required'],
        [['name', 'address', 'landmark', 'cuisine', 'photo'], 'string'],
        [['distance', 'time', 'price'], 'integer'],
        [['business_lunch'], 'boolean'],
    ];
}

}

