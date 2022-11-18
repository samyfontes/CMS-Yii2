<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%account_balance}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%payments}}`
 */
class m221118_123706_create_account_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%account_balance}}', [
            'item_id' => $this->primaryKey(),
            'amount' => $this->float(),
            'for_user' => $this->integer()->notNull(),
            'payment_id' => $this->integer()->notNull(),
            'date' => $this->date(),
        ]);

        // creates index for column `for_user`
        $this->createIndex(
            '{{%idx-account_balance-for_user}}',
            '{{%account_balance}}',
            'for_user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-account_balance-for_user}}',
            '{{%account_balance}}',
            'for_user',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `payment_id`
        $this->createIndex(
            '{{%idx-account_balance-payment_id}}',
            '{{%account_balance}}',
            'payment_id'
        );

        // add foreign key for table `{{%payments}}`
        $this->addForeignKey(
            '{{%fk-account_balance-payment_id}}',
            '{{%account_balance}}',
            'payment_id',
            '{{%payments}}',
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
            '{{%fk-account_balance-for_user}}',
            '{{%account_balance}}'
        );

        // drops index for column `for_user`
        $this->dropIndex(
            '{{%idx-account_balance-for_user}}',
            '{{%account_balance}}'
        );

        // drops foreign key for table `{{%payments}}`
        $this->dropForeignKey(
            '{{%fk-account_balance-payment_id}}',
            '{{%account_balance}}'
        );

        // drops index for column `payment_id`
        $this->dropIndex(
            '{{%idx-account_balance-payment_id}}',
            '{{%account_balance}}'
        );

        $this->dropTable('{{%account_balance}}');
    }
}
