<?php

namespace app\forms;

use app\components\forms\Form;
use Yii;
use yii\web\UploadedFile;

class UploadForm extends Form
{
    public ?UploadedFile $imageFile = null;

    public function rules(): array
    {
        return [
            [
                ['imageFile'],
                'file',
                'skipOnEmpty'              => false,
                'extensions'               => 'png, jpg',
                'maxSize'                  => 1024 * 1024 * 2,
                'mimeTypes'                => 'image/jpeg, image/png',
                'checkExtensionByMimeType' => true,
            ],
        ];
    }

    public function upload(): bool
    {
        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::$app->basePath . '/storage/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}