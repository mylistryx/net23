<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\Signup\CompleteSignupByPhoneForm;
use app\forms\Signup\RequestSignupByPhoneForm;
use Yii;
use yii\web\Response;

final class SignupController extends WebController
{
    public function actionRequest(): Response
    {
        $model = new RequestSignupByPhoneForm();

        if ($model->load(Yii::$app->request->post()) && $model->sendRequest()) {
            return $this->info('Follow email instructions to complete signup', $model->tCategory)->goHome();
        }

        return $this->render('request', [
            'model' => $model,
        ]);

    }

    public function actionComplete(string $token): Response
    {
        $model = new CompleteSignupByPhoneForm($token);

        $this->info('Signup complete!',$model->tCategory);

        return Yii::$app->params['identity.autologinOnSignup'] ? $this->goHome() : $this->redirect([URL_AUTH_LOGIN]);
    }
}