<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <h3>Welcome to home</h3>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'method' => 'post',
            'action' => \yii\helpers\Url::to(['/site/login']),
            'options' => [
                'class' => 'm-t'
            ]
        ]); ?>
            <div class="form-group">
                <?= Html::activeInput('input', $adminMemberModel, 'nick', ['class' => 'form-control', 'placeholder' => '用户名']) ?>
            </div>
            <div class="form-group">
                <?= Html::activePasswordInput($adminMemberModel, 'password', ['class' => 'form-control', 'placeholder' => '密码']) ?>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
        <?php ActiveForm::end(); ?>

        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>