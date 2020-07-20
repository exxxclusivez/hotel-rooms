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

<?php

$this->registerJs('
    
    function removeItem(id, grid) {
        $.SmartMessageBox({
            title : "Подтвердите действие",
            content : "Вы действительно хотите удалить объект безвозвратно?",
            buttons : \'[Отмена][Да, удалить]\'
        }, function(ButtonPressed) {
            if (ButtonPressed === "Да, удалить") {
                $.getJSON("'.Url::to(['ajax-delete']).'", {id:id}, function(resp){
                    if (resp.error == 0) {
                        $.smallBox({
                            title : "Ответ сервера",
                            content : "<i class=\'fa fa-clock-o\'></i> <i>"+ resp.msg + "</i>",
                            color : "#659265",
                            iconSmall : "fa fa-check fa-2x fadeInRight animated",
                            timeout : 4000
                        });
                        $.pjax.reload("#grid");
                    } else {
                        $.smallBox({
                            title : "Ответ сервера",
                            content : "<i class=\'fa fa-clock-o\'></i> <i>" + resp.msg + "</i>",
                            color : "#C46A69",
                            iconSmall : "fa fa-check fa-2x fadeInRight animated",
                            timeout : 4000
                        });
                    }
                });
            }
            if (ButtonPressed == "Отмена") {
                $.smallBox({
                    title : "Ответ сервера",
                    content : "<i class=\'fa fa-clock-o\'></i> <i>Действие по удалению отменено</i>",
                    color : "#659265",
                    iconSmall : "fa fa-times fa-2x fadeInRight animated",
                    timeout : 4000
                });
            }
        });
    }
', yii\web\View::POS_END);
