<?php

use backend\search\HotelRoomOrderSearch;
use common\models\hotel\HotelRoom;
use common\models\hotel\HotelRoomOrder;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $rooms HotelRoom[] */
/* @var $searchModel HotelRoomOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Забронированные номера / ' . Yii::$app->name;
$this->params['title'] = 'Забронированные номера';
$this->params['breadcrumbs'][] = 'Забронированные номера';
?>

<div class="wrapper wrapper-content">
    <div class="animated fadeInRight">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#index-tab">Основная информация</a></li>
            </ul>
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="tab-content">
                        <div id="index-tab" class="tab-pane active">
                            <div class="table-responsive">
                                <?php Pjax::begin(['id' => 'grid', 'timeout' => 4000]);?>
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'tableOptions' => [
                                            'class' => 'table table-bordered',
                                        ],
                                        'columns' => [
                                            [
                                                'class' => 'yii\grid\DataColumn',
                                                'format' => 'raw',
                                                'attribute' => 'id',
                                                'options' => ['style' => 'width:60px;'],
                                            ],


                                            [
                                                'class' => 'yii\grid\DataColumn',
                                                'format' => 'raw',
                                                'attribute' => 'created_date',
                                                'options' => ['style' => 'width:70px;'],
                                                'value' => function ($data) {
                                                    return date('d.m.Y H:i:s', strtotime($data->created_date));
                                                }
                                            ],

                                            [
                                                'attribute' => 'client_name',
                                                'format' => 'raw',
                                                'options' => ['style' => 'width:90px;'],
                                                'class' => 'yii\grid\DataColumn',
                                            ],

                                            [
                                                'attribute' => 'client_mobile',
                                                'format' => 'raw',
                                                'options' => ['style' => 'width:90px;'],
                                                'class' => 'yii\grid\DataColumn',
                                            ],

                                            [
                                                'attribute' => 'hotel_room_id',
                                                'format' => 'raw',
                                                'filter' => ArrayHelper::map($rooms, 'id', 'title'),
                                                'class' => 'yii\grid\DataColumn',
                                                'value' => function ($data) {
                                                    if ($data->room) {
                                                        return $data->room->title;
                                                    }
                                                },
                                            ],

                                            [
                                                'class' => 'yii\grid\DataColumn',
                                                'format' => 'raw',
                                                'attribute' => 'arrival_date',
                                                'options' => ['style' => 'width:70px;'],
                                                'value' => function ($data) {
                                                    return date('d.m.Y', strtotime($data->arrival_date));
                                                }
                                            ],

                                            [
                                                'class' => 'yii\grid\DataColumn',
                                                'format' => 'raw',
                                                'attribute' => 'departure_date',
                                                'options' => ['style' => 'width:70px;'],
                                                'value' => function ($data) {
                                                    return date('d.m.Y', strtotime($data->departure_date));
                                                }
                                            ],

                                            [
                                                'class' => 'yii\grid\DataColumn',
                                                'format' => 'raw',
                                                'filter' => HotelRoomOrder::statuses(),
                                                'attribute' => 'status',
                                                'options' => ['style' => 'width:70px;'],
                                                'value' => function ($data) {
                                                    return HotelRoomOrder::statuses()[$data->status];
                                                }
                                            ],
                                        ],
                                    ]); ?>
                                <?php Pjax::end();?>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>
