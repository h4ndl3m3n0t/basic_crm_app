<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success btn-block']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
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
            ],
        ],
    ]); ?>


</div>
