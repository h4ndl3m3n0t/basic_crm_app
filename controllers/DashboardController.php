<?php

namespace app\controllers;


use app\models\Customer;
use app\models\Order;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\AccessControl;

class DashboardController extends Controller{
  /**
   * @inheritDoc
   */
  public function behaviors()
  {
    return array_merge(
      parent::behaviors(),
      [
        'access' => [
          'class' => AccessControl::class,
          'rules' => [
            [
              'allow' => true,
              'roles' => ['@'],
            ],
          ],
        ]
      ]
    );
  }

  public function actionIndex(){

    //customer Data Provider
    $customerDataProvider = new ActiveDataProvider([
        'query' => Customer::find()
          ->alias('ct')
          ->select(['ct.id','ct.name','count(o.id) as orders'])
          ->leftJoin(['o' => Order::tableName()],'ct.id = o.customer_id')
          ->andWhere([
            'ct.created_by' => \Yii::$app->user->id
          ])
          ->groupBy(['ct.id']),

        'pagination' => [
            'pageSize' => 10
        ],
        /*'sort' => [
            'defaultOrder' => [
                'id' => SORT_DESC,
            ]
        ],
        */
    ]);

    //order data provider
    $orderDataProvider = new ActiveDataProvider([
      'query' => Order::find()
        ->creator(\Yii::$app->user->id)
        ->orderBy([
          'created_at' => SORT_DESC
        ])
        ->limit(5),
    ]);

      //customer No.
      $customerNo = Customer::find()
              ->creator(\Yii::$app->user->id)
              ->count();

      $orderTotal = Order::find()
        ->creator(\Yii::$app->user->id)
        ->count();

      $orderDelivered = Order::find()
        ->creator(\Yii::$app->user->id)
        ->status(Order::STATUS_DELIVERED)
        ->count();

      $orderPending = Order::find()
        ->creator(\Yii::$app->user->id)
        ->status(Order::STATUS_PENDING)
        ->count();

    return $this->render('index',[
      'customerDataProvider' => $customerDataProvider,
      'orderDataProvider' => $orderDataProvider,
      'customerNo' => $customerNo,
      'orderTotal' => $orderTotal,
      'orderDelivered' => $orderDelivered,
      'orderPending' => $orderPending
    ]);
  }
}
