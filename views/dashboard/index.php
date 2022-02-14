<?php

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $customerDataProvider yii\data\ActiveDataProvider */
/* @var $orderDataProvider yii\data\ActiveDataProvider */
/* @var $customerNo integer */
/* @var $orderTotal integer */
/* @var $orderPending integer */
/* @var $orderDelivered integer */


$this->title = 'Dashboard';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-secondary text-light">
                    <div class="card-header">
                        Total Orders: <?= $orderTotal ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="card bg-primary text-light">
                    <div class="card-header">
                        Orders Delivered: <?= $orderDelivered ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="card bg-warning">
                    <div class="card-header">
                        Orders Pending: <?= $orderPending ?>
                    </div>
                </div>
            </div>
        </div>


        <!--grid view here pleases-->
        <div class="row mt-4">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        Customers: <?= $customerNo ?>
                    </div>
                    <div class="card-body">
                        <?= Html::a('Create Customer',['/customer/create'],[
                            'class' => 'btn btn-primary btn-sm btn-block'
                        ]) ?>
                        <!--grid view here pleases-->
                        <?= GridView::widget([
                            'dataProvider' => $customerDataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                // 'id',
                                [
                                    'attribute' => 'name',
                                    'content' => function($model){
                                        return Html::a($model->name,[
                                            '/customer/view',
                                            'id' => $model->id
                                        ]);
                                    }
                                ],
                                [
                                    'attribute' => 'order',
                                    'content' => function($model){
                                        return $model->getOrder()->count();
                                    }
                                ]


                                // 'email:email',
                                // 'number',
                                // 'created_at',
                                //'updated_at',
                                //'created_by',
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">

                <div class="card">
                    <div class="card-header">
                        Last 5 Orders
                    </div>
                    <div class="card-body">
                        <?= Html::a('Create Order',['/order/create'],[
                            'class' => 'btn btn-primary btn-sm btn-block'
                        ]) ?>
                        <!--grid view here pleases-->
                        <?= GridView::widget([
                            'dataProvider' => $orderDataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                // 'id',
                                'product.name',
                                'product.created_at:relativeTime',
                                [
                                    'attribute' => 'status',
                                    'content' => function($model){
                                        return $model->statusLabels()[$model->status];
                                    }
                                ],
                                [
                                    'class' => ActionColumn::class,
                                    'template' => '{update} {delete}',
                                    'buttons' => [
                                        'update' => function($url,$model,$key){
                                            return Html::a('Update',['/order/update', 'id' => $model->id],[
                                                'class' => 'btn btn-warning btn-sm'
                                            ]);
                                        },
                                        'delete' => function($url,$model,$key){
                                            return Html::a('Remove',['/order/delete', 'id' => $model->id],[
                                                'class' => 'btn btn-danger btn-sm',
                                                'data-method' => 'post',
                                                'data-confirm' => 'Are you sure you want to remove this item ?'
                                            ]);
                                        }
                                    ]
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
