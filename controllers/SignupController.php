<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\Signup\CompleteSignupForm;
use app\forms\Signup\RequestSignupForm;
use Yii;
use yii\web\Response;

final class SignupController extends WebController
{
    public function actionRequest(): Response
    {
        $model = new RequestSignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

        }

        return $this->render('request', [
            'model' => $model,
        ]);

    }

    public function actionComplete(): Response
    {
        $model = new CompleteSignupForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->createIdentity();
            $this->success('Signup completed successfully');
        }

        return $this->render('complete', [
            'model' => $model,
        ]);
    }

    public function actionConfirmEmail(string $token): Response
    {
        $model = new ConfirmEmailForm($token);

        $this->success('Email confirmed', $model->tCategory);
        return $this->goHome();
    }
}