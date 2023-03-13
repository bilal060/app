<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\models\Fruit;

class NewFruitController extends Controller
{
    public function actionUpdateFruits()
    {
        $fruitsJson = file_get_contents('https://fruityvice.com/api/fruit/all');
        $fruitsArray = Json::decode($fruitsJson, true);
        
        $newFruits = [];
        foreach ($fruitsArray as $fruitData) {
            $fruit = Fruit::find()->where(['id' => $fruitData['id']])->one();
            if (!$fruit) {
                $newFruits[] = $fruitData;
                $fruit = new Fruit();
                $fruit->id = $fruitData['id'];
            }
            $fruit->name = $fruitData['name'];
            $fruit->genus = $fruitData['genus'];
            $fruit->family = $fruitData['family'];
            $fruit->order = $fruitData['order'];
            $fruit->carbohydrates = ArrayHelper::getValue($fruitData, 'nutritions.carbohydrates', null);
            $fruit->protein = ArrayHelper::getValue($fruitData, 'nutritions.protein', null);
            $fruit->fat = ArrayHelper::getValue($fruitData, 'nutritions.fat', null);
            $fruit->calories = ArrayHelper::getValue($fruitData, 'nutritions.calories', null);
            $fruit->sugar = ArrayHelper::getValue($fruitData, 'nutritions.sugar', null);
            $fruit->save();
        }
        
        if (!empty($newFruits)) {
            $adminEmail = 'test@gmail.com'; // replace with your email
            Yii::$app->mailer->compose('newFruits', ['fruits' => $newFruits])
                ->setTo($adminEmail)
                ->setSubject('New Fruits Added')
                ->send();
        }
    }
}
