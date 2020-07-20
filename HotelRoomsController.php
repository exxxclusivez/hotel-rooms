<?php

namespace frontend\controllers;

use backend\search\HotelRoomSearch;
use common\helpers\ModelHelper;
use common\models\hotel\HotelRoom;
use common\models\hotel\HotelRoomOrder;
use Yii;
use frontend\components\OfflineBehaviour;
use frontend\components\Controller;
use yii\web\Response;

class HotelRoomsController extends Controller
{
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'offline' => [
                'class' => OfflineBehaviour::class,
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new HotelRoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('rooms', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOrder($id)
    {
        $model = HotelRoom::findOne($id);
        if (!$model) {
            return ['error' => 1, 'msg' => 'Номер не найден'];
        }
        return $this->render('order', [
            'model' => $model,
        ]);
    }

    public function actionAjaxOrderSubmit($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new HotelRoomOrder();
        $model->status = HotelRoomOrder::STATUS_WAIT;
        $model->load(Yii::$app->request->post());
        if ($model->validate()) {
            if (!$model->checkRoom()) {
                return ['error' => 1, 'msg' => 'Комната уже занята'];
            }
        }

        if ($model->save()) {
            return ['error' => 0, 'msg' => 'Заказ успешно создан'];
        }

        return ['error' => 1, 'msg' => ModelHelper::listErrors($model)];
    }
}
