<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%subjects}}`.
 */
class m221116_114901_add_ending_date_column_to_subjects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%subjects}}', 'ending_date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%subjects}}', 'ending_date');
    }
}
