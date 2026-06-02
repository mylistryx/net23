<?php
/**
 * @var View $this
 * @var \app\models\Identity\Identity $user
 */

use app\models\Identity\Identity;
use yii\web\View;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
