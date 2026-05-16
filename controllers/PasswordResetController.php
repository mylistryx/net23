<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\PasswordReset\CompletePasswordResetForm;
use app\forms\PasswordReset\RequestPasswordResetForm;
use Yii;
use yii\web\Response;

final class PasswordResetController extends WebController
{
    public function actionRequest(): Response
    {
        $model = new RequestPasswordResetForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->sendRequest();
            $this->info('Follow email instructions', $model->tCategory);
            return $this->goHome();
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }

    public function actionComplete(): Response
    {
        $model = new CompletePasswordResetForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->resetPassword();
            $this->success('New password set', $model->tCategory);
            return $this->goHome();
        }

        $this->error('Incorrect password reset token', $model->tCategory);
        return $this->redirect('request');
    }
}