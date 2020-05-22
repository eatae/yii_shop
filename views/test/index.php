<?php
use yii\helpers\Html;
use yii\helpers\Url;


var_dump($test);

?>

<?= Html::a('customer_form', ['test/show-form'], ['class'=>'btn btn-default']); ?>
<?= Html::a('models', ['test/models'], ['class'=>'btn btn-default']); ?>
<?= Html::a('logs', ['test/logs'], ['class'=>'btn btn-default']); ?>
<?= Html::a('mail', ['test/mail'], ['class'=>'btn btn-default']); ?>
<?= Html::a('debug', ['test/debug'], ['class'=>'btn btn-default']); ?>

