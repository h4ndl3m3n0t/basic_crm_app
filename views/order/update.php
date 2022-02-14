<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\Order;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Update Order ';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList((new Order)->statusLabels()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
