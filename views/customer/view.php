<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

    <h1><?= Html::encode('Customer: '.$this->title) ?></h1>

    <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) ?>
                        <br>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-block',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-header">
                        Contact Info
                    </div>
                    <div class="card-body">
                        Email: <b><?= $model->email ?></b>
                        <br>
                        Phone: <b><?= $model->number ?></b>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-header">
                        Total Order: <?= $model->getOrder()->count() ?>
                    </div>
                </div>
            </div>
        </div>

        <!--grid view here pleases-->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!--grid view here pleases-->
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                // 'id',
                                'product.name',
                                'product.cat.name',
                                'created_at:datetime',
                                [
                                    'class' => ActionColumn::class,
                                    'template' => '{update} {delete}',
                                    'buttons' => [
                                        'update' => function($url,$model,$key){
                                            return Html::a('Update',$url,[
                                                'class' => 'btn btn-warning btn-sm'
                                            ]);
                                        },
                                        'delete' => function($url,$model,$key){
                                            return Html::a('Remove',$url,[
                                                'class' => 'btn btn-danger btn-sm',
                                                'data-method' => 'post',
                                                'data-confirm' => 'Are you sure you want to remove this item ?'
                                            ]);
                                        }
                                    ]
                                ]
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>

</div>
