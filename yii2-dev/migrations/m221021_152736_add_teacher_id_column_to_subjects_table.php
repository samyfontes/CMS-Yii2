<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%subjects}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m221021_152736_add_teacher_id_column_to_subjects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%subjects}}', 'teacher_id', $this->integer()->Null());

        // creates index for column `teacher_id`
        $this->createIndex(
            '{{%idx-subjects-teacher_id}}',
            '{{%subjects}}',
            'teacher_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-subjects-teacher_id}}',
            '{{%subjects}}',
            'teacher_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-subjects-teacher_id}}',
            '{{%subjects}}'
        );

        // drops index for column `teacher_id`
        $this->dropIndex(
            '{{%idx-subjects-teacher_id}}',
            '{{%subjects}}'
        );

        $this->dropColumn('{{%subjects}}', 'teacher_id');
    }
}
