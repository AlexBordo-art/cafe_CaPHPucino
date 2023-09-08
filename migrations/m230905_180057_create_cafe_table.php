<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cafe}}`.
 */
class m230905_180057_create_cafe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cafe', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->string(),
            'landmark' => $this->string(),
            'cuisine' => $this->string(),
            'distance' => $this->integer(),
            'time' => $this->integer(),
            'photo' => $this->string(),
            'business_lunch' => $this->boolean(),
            'price' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cafe');
    }
}
