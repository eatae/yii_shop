<?php
/* @var $signupForm app\models\forms\SignupForm */
/* @var $signupForm app\models\forms\LoginForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="row">
    <hr />


    <div class="col-md-6 col-sm-6">
        <h3>Войти</h3>
        <hr />
        <?php $form = ActiveForm::begin(['class'=>'form-group', 'action' => ['user/login'],]) ?>
        <div class="form-group">
            <?= $form->field($loginForm, 'email') ?>
        </div>
        <div class="form-group">
            <?= $form->field($loginForm, 'password')->passwordInput() ?>
        </div>
        <?= Html::submitButton('Войти', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
        <?php ActiveForm::end() ?>
    </div>


    <div class="col-md-6 col-sm-6">
        <h3>Зарегестрироваться</h3>
        <hr />
        <?php $form = ActiveForm::begin(['class'=>'form-group', 'action' => ['user/signup'],]) ?>
        <div class="form-group">
            <?= $form->field($signupForm, 'username') ?>
        </div>
        <div class="form-group">
            <?= $form->field($signupForm, 'email') ?>
        </div>
        <div class="form-group">
            <?= $form->field($signupForm, 'password')->passwordInput() ?>
        </div>
        <?= Html::submitButton('Зарегестрироваться', ['class' => 'btn btn-default', 'name' => 'signup-button']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>