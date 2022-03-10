<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lots}}`.
 */
class m210514_082800_create_lots_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lots}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(512)->notNull(),
            'description' => $this->text(),'tags' => $this->string(512),
            'tags' => $this->string(512),
            'product_id' => $this->integer(11)->notNull(),
            'row' => $this->string(512),
            'coordinates' => $this->string(512),
            'weather' => $this->text(),
            'lot_number' => $this->string(512)->notNull(),
            'quantity' => $this->integer(11)->notNull(),
            'date' => $this->date(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
           '{{%idx-lots-product_id}}',
           '{{%lots}}',
           'product_id'
        );

        // add foreign key for table `{{%lots}}`
        $this->addForeignKey(
            '{{%fk-lots-product_id}}',
            '{{%lots}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );




    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%lots}}`
        $this->dropForeignKey(
            '{{%fk-lots-product_id}}',
            '{{%lots}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-lots-product_id}}',
            '{{%lots}}'
        );
        $this->dropTable('{{%lots}}');
    }
}
