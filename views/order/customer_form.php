<?php
/* @var $formModel app\models\forms\CustomerForm */
/* @var $user app\models\User */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


$customer = ($user) ? $user->customer : null;

?>
<div class="row">
    <?php
    if($customer) { ?>
        <div class="col-md-6 col-sm-6">
            <h3>Данные о покупателе</h3>
            <hr />
            <?php $form = ActiveForm::begin(['class'=>'form-group', 'action' => ['order/create-order']]) ?>
            <div class="form-group">
                <?= $form->field($formModel, 'first_name')->textInput(['value' => $customer->first_name]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($formModel, 'last_name')->textInput(['value' => $customer->last_name]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($formModel, 'email')->textInput(['value' => (string)$customer->email ?: (string)$user->email]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($formModel, 'address')->textInput(['value' => $customer->address]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($formModel, 'phone')->textInput(['value' => $customer->phone]) ?>
            </div>
            <? if (!$user) { ?>
                <div class="alert alert-success" role="alert">
                    Вы сможете просматривать историю ваших заказов если <a href="<?= Url::to('/user/login') ?>" class="alert-link">войдете или зарегестрируетесь</a>.
                </div>
            <? } ?>
            <?= Html::a('Назад', 'javascript:history.back()', ['class' => 'btn btn-default']) ?>
            <?= Html::submitButton('Готово', ['class' => 'btn btn-green pull-right', 'name' => 'signup-button']) ?>
            <?php ActiveForm::end() ?>
        </div>
    <?php }
    else { ?>
        <div class="col-md-6 col-sm-6">
            <h3>Данные о покупателе</h3>
            <hr />
            <?php $form = ActiveForm::begin(['class'=>'form-group', 'action' => ['order/create-order']]) ?>
            <div class="form-group">
                <?= $form->field($formModel, 'first_name')->textInput(['placeholder' => 'First name']) ?>
            </div>
            <div class="form-group">
                <?= $form->field($formModel, 'last_name')->textInput(['placeholder' => 'Last name']) ?>
            </div>
            <div class="form-group">
                <?= $form->field($formModel, 'email')->textInput(['placeholder' => 'Email']) ?>
            </div>
            <div class="form-group">
                <?= $form->field($formModel, 'address')->textInput(['placeholder' => 'Address']) ?>
            </div>
            <div class="form-group">
                <?= $form->field($formModel, 'phone')->textInput(['placeholder' => 'Phone']) ?>
            </div>
            <? if (!$user) { ?>
                <div class="alert alert-success" role="alert">
                    Вы сможете просматривать историю ваших заказов если <a href="<?= Url::to('/user/login') ?>" class="alert-link">войдете или зарегестрируетесь</a>.
                </div>
            <? } ?>
            <?= Html::a('Назад', 'javascript:history.back()', ['class' => 'btn btn-default']) ?>
            <?= Html::submitButton('Готово', ['class' => 'btn btn-green pull-right', 'name' => 'signup-button']) ?>
            <?php ActiveForm::end() ?>
        </div>
    <?php } ?>
</div>
