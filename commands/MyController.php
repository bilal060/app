<?php

namespace app\commands;


class MyController extends yii\console\Controller{

    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

}