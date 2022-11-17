<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%payments}}`.
 */
class m221117_132923_add_date_column_to_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%payments}}', 'date', $this->date());
        $this->addColumn('payments', 'status',"ENUM('pending', 'closed')");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%payments}}', 'date');
        $this->dropColumn('{{%payments}}', 'status');
    }
}
