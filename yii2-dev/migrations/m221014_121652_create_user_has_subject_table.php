<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_has_subject}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%subjects}}`
 */
class m221014_121652_create_user_has_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_has_subject}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_has_subject-user_id}}',
            '{{%user_has_subject}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_has_subject-user_id}}',
            '{{%user_has_subject}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            '{{%idx-user_has_subject-subject_id}}',
            '{{%user_has_subject}}',
            'subject_id'
        );

        // add foreign key for table `{{%subjects}}`
        $this->addForeignKey(
            '{{%fk-user_has_subject-subject_id}}',
            '{{%user_has_subject}}',
            'subject_id',
            '{{%subjects}}',
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
            '{{%fk-user_has_subject-user_id}}',
            '{{%user_has_subject}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_has_subject-user_id}}',
            '{{%user_has_subject}}'
        );

        // drops foreign key for table `{{%subjects}}`
        $this->dropForeignKey(
            '{{%fk-user_has_subject-subject_id}}',
            '{{%user_has_subject}}'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            '{{%idx-user_has_subject-subject_id}}',
            '{{%user_has_subject}}'
        );

        $this->dropTable('{{%user_has_subject}}');
    }
}
