<?php

namespace app\models;

use yii\db\ActiveRecord;

class Fruit extends ActiveRecord
{
    public static function tableName()
    {
        return 'fruit';
    }

    public function getNutrition()
    {
        return $this->hasOne(Nutrition::class, ['fruit_FK_Id' => 'id']);
    }
}
