<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Message extends ActiveRecord
{
    public static function tableName()
    {
        return 'message';
    }

    public function rules()
    {
        return [
            [['text', 'id_cafe'], 'required'],
            [['text'], 'string'],
            [['id_cafe'], 'integer'],
        ];
    }
}
