<?php
/* @var $customerForm app\models\forms\CustomerForm */


use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$user = Yii::$app->user->identity;
//$customer = ($user) ? $user->getCustomer() : null;

var_dump($test)
?>

<div class="row">

    <div class="col-md-6 col-sm-6">
        <h3>Данные о покупателе</h3>
        <hr />
        <?php $form = ActiveForm::begin(['class'=>'form-group', 'action' => ['test/show-form'],]) ?>
        <div class="form-group">
            <?= $form->field($customerForm, 'first_name')->textInput(['value' => $o->aa ?: 'hello']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($customerForm, 'last_name') ?>
        </div>
        <div class="form-group">
            <?= $form->field($customerForm, 'email') ?>
        </div>
        <div class="form-group">
            <?= $form->field($customerForm, 'address') ?>
        </div>
        <div class="form-group">
            <?= $form->field($customerForm, 'phone') ?>
        </div>
        <? if (!$user) { ?>
            <div class="alert alert-success" role="alert">
                Вы сможете просматривать историю ваших заказов если <a href="<?= Url::to('/user/login') ?>" class="alert-link">войдете или зарегестрируетесь</a>.
            </div>
        <? }
        ?>
        <?= Html::submitButton('Готово', ['class' => 'btn btn-default', 'name' => 'signup-button']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
