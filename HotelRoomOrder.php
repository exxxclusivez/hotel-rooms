<?php

namespace common\models\hotel;

use common\behaviors\HtmlPurifierFilterBehavior;
use common\helpers\DataHelper;
use common\models\Program;
use redspace\helpers\behaviors\DateTimeBehaviour;
use Yii;

/**
 * This is the model class for table "hotel_room_order".
 *
 * @property int $id
 * @property int $hotel_room_id Номер
 * @property string $client_name Имя клиента
 * @property string $client_mobile Мобильный клиента
 * @property string $created_date Дата создания
 * @property string $arrival_date Дата заезда
 * @property string $departure_date Дата отъезда
 * @property string $status
 *
 * @property HotelRoom $room
 */
class HotelRoomOrder extends \yii\db\ActiveRecord
{

    const STATUS_WAIT = 'wait';
    const STATUS_APPROVED = 'approved';
    const STATUS_CANCELED = 'canceled';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_room_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_room_id', 'client_name', 'client_mobile', 'arrival_date', 'departure_date'], 'required'],
            [['created_date', 'arrival_date', 'departure_date'], 'safe'],
            ['status', 'in', 'range' => array_keys(self::statuses())],
            ['hotel_room_id', 'exist', 'targetClass' => HotelRoom::class, 'targetAttribute' => 'id'],
            [['client_name'], 'filter', 'filter' => 'trim'],
            [['client_name'], 'match', 'pattern' => '/^[а-яё\-]+$/iu', 'message' => 'Поле "{attribute}" должно быть заполнено с использованием алфавита русского языка.', 'skipOnEmpty' => true],
            [['client_mobile'], 'string', 'max' => 32],
            ['arrival_date', 'dateValidator']

        ];
    }

    public function dateValidator($attribute, $params)
    {
        $arrival_date = strtotime($this->arrival_date);
        $departure_date = strtotime($this->departure_date);

        if ($departure_date < $arrival_date) {
            $this->addError($attribute, Yii::t('app', 'Дата заезда не может быть раньше чем дата выезда'));
        }
    }


    public function behaviors()
    {
        return [
            [
                'class' => DateTimeBehaviour::class,
                'createdAtAttribute' => 'created_date',
                'updatedAtAttribute' => false,
            ],
             HtmlPurifierFilterBehavior::class,
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->client_mobile = DataHelper::cleanMobile($this->client_mobile);
            $this->arrival_date = date('Y-m-d', strtotime($this->arrival_date));
            $this->departure_date = date('Y-m-d', strtotime($this->departure_date));
            return true;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotel_room_id' => 'Номер',
            'client_name' => 'Имя клиента',
            'client_mobile' => 'Мобильный клиента',
            'created_date' => 'Дата заявки',
            'arrival_date' => 'Дата заезда',
            'departure_date' => 'Дата выезда',
            'status' => 'Статус',
        ];
    }


    public static function statuses()
    {
        return [
            self::STATUS_WAIT => 'Ожидает',
            self::STATUS_APPROVED => 'Подтвержден',
            self::STATUS_CANCELED => 'Отменен',
        ];
    }

    public  function checkRoom()
    {
        $model = HotelRoomOrder::find()
            ->where(['hotel_room_id' => $this->hotel_room_id, 'status' => [HotelRoomOrder::STATUS_WAIT, HotelRoomOrder::STATUS_APPROVED]])
            ->andWhere(':date BETWEEN arrival_date AND departure_date', [':date' => date('Y-m-d', strtotime($this->arrival_date))])
            ->one();
       return $model ? false : true;
    }

    /**
     * {@inheritdoc}
     * @return HotelRoomOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HotelRoomOrderQuery(get_called_class());
    }

    public function getRoom()
    {
        return $this->hasOne(HotelRoom::class, ['id' => 'hotel_room_id']);
    }
}
