<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220211_050550_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11)
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-category-created_by}}',
            '{{%category}}',
            'created_by'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-category_created_by}}',
            '{{%category}}',
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
            '{{%fk-category-created_by}}',
            '{{%category}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-category-created_by}}',
            '{{%category}}'
        );

        $this->dropTable('{{%category}}');
    }
}
