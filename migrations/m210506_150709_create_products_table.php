<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m210506_150709_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'picture_id' => $this->string(16)->notNull()->unique(),
            'title' => $this->string(512)->notNull(),
            'description' => $this->text(),
            'tags' => $this->string(512),
            'file_name' => $this->string(512),
            'status' => $this->integer(11),

            //components
            'component1_id' => $this->integer(11),
            'component2_id' => $this->integer(11),
            'component3_id' => $this->integer(11),
        ]);

        // creates index for column `component1_id`
        $this->createIndex(
           '{{%idx-products-component1_id}}',
           '{{%products}}',
           'component1_id'
        );
        // creates index for column `component2_id`
        $this->createIndex(
           '{{%idx-products-component2_id}}',
           '{{%products}}',
           'component2_id'
        );
        // creates index for column `component3_id`
        $this->createIndex(
           '{{%idx-products-component3_id}}',
           '{{%products}}',
           'component3_id'
        );

        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-products-component1_id}}',
            '{{%products}}',
            'component1_id',
            '{{%components}}',
            'id',
            'CASCADE'
        );
        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-products-component2_id}}',
            '{{%products}}',
            'component2_id',
            '{{%components}}',
            'id',
            'CASCADE'
        );
        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-products-component3_id}}',
            '{{%products}}',
            'component3_id',
            '{{%components}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-products-component3_id}}',
            '{{%products}}'
        );
        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-products-component2_id}}',
            '{{%products}}'
        );
        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-products-component1_id}}',
            '{{%products}}'
        );

        // drops index for column `component3_id`
        $this->dropIndex(
            '{{%idx-products-component3_id}}',
            '{{%products}}'
        );

        // drops index for column `component2_id`
        $this->dropIndex(
            '{{%idx-products-component2_id}}',
            '{{%products}}'
        );

        // drops index for column `component1_id`
        $this->dropIndex(
            '{{%idx-products-component1_id}}',
            '{{%products}}'
        );

        // drops table
        $this->dropTable('{{%products}}');
    }
}
