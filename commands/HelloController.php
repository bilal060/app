<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;
use Response;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\httpclient\Client;
use app\models\Fruit;
use app\models\Nutrition;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
   
    public function actionIndex()
    {
        $client = new \yii\httpclient\Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://fruityvice.com/api/fruit/all')
            ->send();
        if ($response->isOk) {
            // echo "Response OK\n";
            $fruits = $response->getData();
            $newFruits = $this->getNewFruits($fruits);
            if (!empty($newFruits)) {
                echo "Email OK\n";
                foreach ($newFruits as $fruit) {
                    $checkId = $fruit['id'];
                    $available = $this->existFruit($checkId);
                    echo $available;
                    echo "Emalsjfhdiuashfail OK\n";
                    if(!$available){
                        Yii::$app->db->createCommand()
                        ->insert('fruit', [
                            'name' => $fruit['name'],
                            'genus' => $fruit['genus'], 
                            'fruit_id' => $fruit['id'],
                            'family' => $fruit['family'],
                            'order' => $fruit['order'],
                            'carbohydrates' => $fruit['nutritions']['carbohydrates'],
                            'protein' => $fruit['nutritions']['protein'],
                            'fat' => $fruit['nutritions']['fat'],
                            'calories' => $fruit['nutritions']['calories'],
                            'sugar' => $fruit['nutritions']['sugar']
                        ])
                            ->execute();
                            $message = Yii::$app->mailer->compose()
                            ->setTo('sh.hafizhasnain.com')
                            ->setSubject('New fruits added')
                            ->setHtmlBody($this->renderPartial('new-fruits', ['fruits' => $newFruits]));
                        $message->send();
                    }
                 
                }
            }
        }
    }
    
    private function getNewFruits($fruits)
    {
        $newFruits = [];
        foreach ($fruits as $fruit) {
            $existingFruit = Fruit::findOne(['name' => $fruit['name']]);
            if (!$existingFruit) {
                $newFruits[] = $fruit;
            }
        }
        return $newFruits;
    }
    private function existFruit($fruitId)
    {
        $FruitId = Fruit::findOne(['id' => $fruitId]);
        phpinfo($FruitId);
        return $fruitId;
    }
    
}
