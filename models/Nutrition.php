<?php

namespace app\models;

use yii\db\ActiveRecord;

class Nutrition extends ActiveRecord
{
    public static function tableName()
    {
        return 'nutrition';
    }

    public function getFruit()
    {
        return $this->hasOne(Fruit::class, ['id' => 'fruit_FK_Id']);
    }
}
