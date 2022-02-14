<?php

use app\models\Customer;
use app\models\Order;
use app\models\Product;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\bootstrap4\ActiveForm */

?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map(Customer::find()->creator(Yii::$app->user->id)->all(),'id','name')) ?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::find()->creator(Yii::$app->user->id)->all(),'id','name')) ?>

    <?= $form->field($model, 'status')->dropDownList((new Order)->statusLabels()) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success btn-sm btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
