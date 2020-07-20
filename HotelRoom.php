<?php

namespace common\models\hotel;

use Yii;

/**
 * This is the model class for table "hotel_room".
 *
 * @property int $id
 * @property string $title Название
 * @property string|null $description Описание
 */
class HotelRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
        ];
    }

    /**
     * {@inheritdoc}
     * @return HotelRoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HotelRoomQuery(get_called_class());
    }
}
