<?php

use yii\db\Migration;

/**
 * Class m180915_125920_add_column_auth_token_to_user
 */
class m180915_125920_add_column_auth_token_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("users", "auth_token", "varchar(60) NULL DEFAULT NULL");
        //todo add index for search by pass.
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("users", "auth_token");
    }

}
