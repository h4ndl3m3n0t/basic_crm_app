<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 */
class m220211_051449_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'cat_id' => $this->integer(11),
            'price' => $this->double(2)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11)
        ]);

        // creates index for column `cat_id`
        $this->createIndex(
            '{{%idx-product-cat_id}}',
            '{{%product}}',
            'cat_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-product-cat_id}}',
            '{{%product}}',
            'cat_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-product-created_by}}',
            '{{%product}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-product_created_by}}',
            '{{%product}}',
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
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-product-cat_id}}',
            '{{%product}}'
        );

        // drops index for column `cat_id`
        $this->dropIndex(
            '{{%idx-product-cat_id}}',
            '{{%product}}'
        );

         // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-product-created_by}}',
            '{{%product}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-product-created_by}}',
            '{{%product}}'
        );

        $this->dropTable('{{%product}}');
    }
}
