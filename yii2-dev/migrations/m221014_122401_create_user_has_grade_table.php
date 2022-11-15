<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_has_grade}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%subjects}}`
 */
class m221014_122401_create_user_has_grade_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_has_grade}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'grade' => $this->float(),
            'on_subject' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_has_grade-user_id}}',
            '{{%user_has_grade}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_has_grade-user_id}}',
            '{{%user_has_grade}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `on_subject`
        $this->createIndex(
            '{{%idx-user_has_grade-on_subject}}',
            '{{%user_has_grade}}',
            'on_subject'
        );

        // add foreign key for table `{{%subjects}}`
        $this->addForeignKey(
            '{{%fk-user_has_grade-on_subject}}',
            '{{%user_has_grade}}',
            'on_subject',
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
            '{{%fk-user_has_grade-user_id}}',
            '{{%user_has_grade}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_has_grade-user_id}}',
            '{{%user_has_grade}}'
        );

        // drops foreign key for table `{{%subjects}}`
        $this->dropForeignKey(
            '{{%fk-user_has_grade-on_subject}}',
            '{{%user_has_grade}}'
        );

        // drops index for column `on_subject`
        $this->dropIndex(
            '{{%idx-user_has_grade-on_subject}}',
            '{{%user_has_grade}}'
        );

        $this->dropTable('{{%user_has_grade}}');
    }
}
