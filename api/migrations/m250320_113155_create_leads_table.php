<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%leads}}`.
 */
class m250320_113155_create_leads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%leads}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'status' => $this->string(),
            'message' => $this->text(),
            'comment' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%leads}}');
    }
}
