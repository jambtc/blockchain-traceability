<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lots_hash}}`.
 */
class m210514_084618_create_lots_hash_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lots_hash}}', [
            'id' => $this->primaryKey(),
            'lot_id' => $this->integer(11)->notNull(),
            'hash' => $this->string(512),
            'txhash' => $this->string(512),
        ]);

        // creates index for column `lot_id`
        $this->createIndex(
           '{{%idx-lots_hash-lot_id}}',
           '{{%lots_hash}}',
           'lot_id'
        );

        // add foreign key for table `{{%lots_hash}}`
        $this->addForeignKey(
            '{{%fk-lots_hash-lot_id}}',
            '{{%lots_hash}}',
            'lot_id',
            '{{%lots}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%lots_hash}}`
        $this->dropForeignKey(
            '{{%fk-lots_hash-lot_id}}',
            '{{%lots}}'
        );

        // drops index for column `lot_id`
        $this->dropIndex(
            '{{%idx-lots_hash-lot_id}}',
            '{{%lots}}'
        );
        $this->dropTable('{{%lots_hash}}');
    }
}
