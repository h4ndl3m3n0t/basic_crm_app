<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_customer".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $number
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'number'], 'required'],
            [['created_at', 'updated_at', 'created_by'], 'default', 'value' => null],
            [['created_at', 'updated_at', 'created_by'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            [['number'], 'string', 'max' => 20],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'number' => 'Number',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\OrderQuery
     */
    public function getOrder()
    {
        return $this->hasMany(Order::class, ['customer_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CustomerQuery(get_called_class());
    }
}
