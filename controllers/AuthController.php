<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\Auth\LoginByPhoneForm;
use Yii;
use yii\web\Response;

final class AuthController extends WebController
{
    public function actionLogin(): Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginByPhoneForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}