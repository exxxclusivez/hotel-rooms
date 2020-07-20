<?php

namespace backend\search;

use common\models\hotel\HotelRoomOrder;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HotelRoomOrderSearch represents the model behind the search form about `common\models\hotel\HotelRoomOrder`.
 */
class HotelRoomOrderSearch extends HotelRoomOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel_room_id'], 'integer'],
            [['created_date', 'arrival_date', 'departure_date'], 'safe'],
            ['status', 'in', 'range' => array_keys(self::statuses())],
            [['client_name'], 'string', 'max' => 64],
            [['client_mobile'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = HotelRoomOrder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'hotel_room_id' => $this->hotel_room_id,
            'arrival_date' => $this->arrival_date,
            'departure_date' => $this->departure_date,
        ]);

        $query->andFilterWhere(['like', 'client_name', $this->client_name]);
        $query->andFilterWhere(['like', 'client_mobile', $this->client_mobile]);

        return $dataProvider;
    }
}
