<?php

namespace app\models;

use Yii;

class FavoriteFruit extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'fav_fruits';
    }
    public function getFruit()
    {
        return $this->hasOne(Fruit::className(), ['fruit_id' => 'id']);
    }

}
