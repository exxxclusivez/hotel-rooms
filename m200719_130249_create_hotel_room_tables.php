<?php

use yii\db\Migration;

/**
 * Class m200719_130249_create_hotel_room_tables
 */
class m200719_130249_create_hotel_room_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TABLE `hotel_room_order` (
          `id` int(11) NOT NULL,
          `hotel_room_id` int(11) NOT NULL COMMENT 'Номер',
          `client_name` varchar(64) NOT NULL COMMENT 'Имя клиента',
          `client_mobile` varchar(32) NOT NULL COMMENT 'Мобильный клиента',
          `created_date` datetime NOT NULL COMMENT 'Дата создания',
          `arrival_date` date NOT NULL COMMENT 'Дата заезда',
          `departure_date` date NOT NULL COMMENT 'Дата отъезда',
          `status` enum('wait','approved','canceled' COMMENT 'Статус заказа' NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Забронированные номера';
        
        ALTER TABLE `hotel_room_order`
          ADD PRIMARY KEY (`id`),
          ADD KEY `hotel_room_id` (`hotel_room_id`);
        ALTER TABLE `hotel_room_order`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        ");

        $this->execute("CREATE TABLE `hotel_room` (
          `id` int(11) NOT NULL,
          `title` varchar(64) NOT NULL COMMENT 'Название',
          `description` text COMMENT 'Описание'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Справочник номеров гостиницы';
        
        ALTER TABLE `hotel_room`
          ADD PRIMARY KEY (`id`);
        ALTER TABLE `hotel_room`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("hotel_room");
        $this->dropTable("hotel_room_order");
    }
}
