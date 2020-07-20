<?php

namespace common\models\hotel;

/**
 * This is the ActiveQuery class for [[HotelRoomOrder]].
 *
 * @see HotelRoomOrder
 */
class HotelRoomOrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HotelRoomOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HotelRoomOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
