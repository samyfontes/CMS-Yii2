<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%subjects}}`
 */
class m221014_121845_create_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payments}}', [
            'id' => $this->primaryKey(),
            'from_user' => $this->integer()->notNull(),
            'amount' => $this->float(),
            'for_subject' => $this->integer()->notNull(),
        ]);

        // creates index for column `from_user`
        $this->createIndex(
            '{{%idx-payments-from_user}}',
            '{{%payments}}',
            'from_user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-payments-from_user}}',
            '{{%payments}}',
            'from_user',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `for_subject`
        $this->createIndex(
            '{{%idx-payments-for_subject}}',
            '{{%payments}}',
            'for_subject'
        );

        // add foreign key for table `{{%subjects}}`
        $this->addForeignKey(
            '{{%fk-payments-for_subject}}',
            '{{%payments}}',
            'for_subject',
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
            '{{%fk-payments-from_user}}',
            '{{%payments}}'
        );

        // drops index for column `from_user`
        $this->dropIndex(
            '{{%idx-payments-from_user}}',
            '{{%payments}}'
        );

        // drops foreign key for table `{{%subjects}}`
        $this->dropForeignKey(
            '{{%fk-payments-for_subject}}',
            '{{%payments}}'
        );

        // drops index for column `for_subject`
        $this->dropIndex(
            '{{%idx-payments-for_subject}}',
            '{{%payments}}'
        );

        $this->dropTable('{{%payments}}');
    }
}
