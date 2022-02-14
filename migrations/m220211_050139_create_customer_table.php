<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m220211_050139_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'number' => $this->string(20)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11)
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-customer-created_by}}',
            '{{%customer}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-customer-created_by}}',
            '{{%customer}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-customer-created_by}}',
            '{{%customer}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-customer-created_by}}',
            '{{%customer}}'
        );

        $this->dropTable('{{%customer}}');
    }
}
