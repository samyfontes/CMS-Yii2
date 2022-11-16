<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%subjects}}`.
 */
class m221116_114843_add_start_date_column_to_subjects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%subjects}}', 'starting_date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%subjects}}', 'starting_date');
    }
}
