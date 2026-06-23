<?php
/**
 * @var $this View
 * @var $model RequestSignupByPhoneForm
 */

use app\components\oauth\Social;
use app\forms\Signup\RequestSignupByPhoneForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\fontawesome\assets\FontAwesomeAsset;
use yii\validators\PhoneValidator\PhoneInput;
use yii\web\View;
use yii\widgets\MaskedInput;

FontAwesomeAsset::register($this);

$this->title = 'Request signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-2 offset-4">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                    'mask' => '+7 (999) 999-9999',
            ]) ?>

            <div class="form-group ">
                <div class="d-grid gap-2">
                    <?= Html::submitButton('Signup', [
                            'class' => [
                                    'btn',
                                    'btn-primary',
                            ],
                            'name'  => 'signup-button',
                    ]) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
