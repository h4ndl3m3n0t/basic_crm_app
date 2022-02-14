<?php

use yii\db\Migration;

/**
 * Class m220211_060021_insert_admin_account_to_user_table
 */
class m220211_060021_insert_admin_account_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}',[
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'email' => 'admin@admin.com',
            'status' => 10,
            'verification_token' => Yii::$app->security->generateRandomString() . '_' . time(),
            'created_at' => time(),
            'updated_at' => time(),
            'roles' => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}',['username' => 'admin']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_060021_insert_admin_account_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
