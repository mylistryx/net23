<?php
/**
 * @var $this View
 * @var $model RequestSignupForm
 */

use app\components\oauth\Social;
use app\forms\Signup\RequestSignupForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\fontawesome\assets\FontAwesomeAsset;
use yii\fontawesome\FAR;
use yii\fontawesome\FAS;
use yii\web\View;
use function app\components\oauth\Social;

FontAwesomeAsset::register($this);

$this->title = 'Request signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-5 offset-4">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to signup:</p>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group ">
                <div class="d-grid gap-2">
                    <?= Html::submitButton('Signup', [
                            'class' => [
                                    'btn',
                                    'btn-primary',
                                    ''
                            ],
                            'name'  => 'signup-button',
                    ]) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <div class="row">
        <div class="col-5 offset-4">
            or use oAuth via social network
            <br>
            <?= Social::icon('tg') ?>
            <?= Social::icon('vk') ?>
            <?= Social::icon('ok') ?>
            <?= Social::icon('x') ?>
            <?= Social::icon('whatsapp') ?>
            <?= Social::icon('fb') ?>
            <?= Social::icon('instagram') ?>
            <?= Social::icon('google') ?>
            <?= Social::icon('spotify') ?>
        </div>
    </div>
</div>
