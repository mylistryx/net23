<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\UploadForm;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

final class TestController extends WebController
{
    public function actionIndex(): Response
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                return $this->success('OK')->redirect('index');
            }

            dd($model->errors);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}