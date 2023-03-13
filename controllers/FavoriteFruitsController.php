<?php

namespace app\controllers;
use Yii;
use app\models\FavoriteFruit;
use yii\web\Controller;
use yii\web\Response;

class FavoriteFruitsController extends Controller
{
    public function actionAdd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $fruitId = Yii::$app->request->post('fruit_id');
        $favoriteFruit = FavoriteFruit::findOne(['fruit_id' => $fruitId]);

        if ($favoriteFruit) {
            return ['success' => false, 'message' => 'This fruit is already in your favorites.'];
        }

        $favoriteFruit = new FavoriteFruit();
        $favoriteFruit->fruit_id = $fruitId;

        if ($favoriteFruit->save()) {
            return ['success' => true, 'message' => 'Added to favorites.'];
        } else {
            Yii::error('Error adding favorite fruit: ' . print_r($favoriteFruit->errors, true));
            return ['success' => false, 'message' => 'Error adding to favorites.'];
        }
    }
}
