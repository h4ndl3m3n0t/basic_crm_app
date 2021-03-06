<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Order]].
 *
 * @see \app\models\Order
 */
class OrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Order[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Order|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function client($id){
        return $this->andWhere([
            'customer_id' => $id
        ]);
    }

    public function creator($id){
        return $this->andWhere([
            'created_by' => $id
        ]);
    }

    public function status($status){
        return $this->andWhere([
            'status' => $status
        ]);
    }
}
