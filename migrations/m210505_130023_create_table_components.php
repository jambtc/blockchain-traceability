<?php

use yii\db\Migration;

/**
 * Class m210505_130023_create_table_components
 */
class m210505_130023_create_table_components extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%components}}', [
            'id' => $this->primaryKey(),
            'picture_id' => $this->string(16)->notNull()->unique(),
            'title' => $this->string(512)->notNull(),
            'description' => $this->text(),
            'tags' => $this->string(512),
            'file_name' => $this->string(512),
            'status' => $this->integer(11),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%components}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210505_130023_create_table_components cannot be reverted.\n";

        return false;
    }
    */
}
