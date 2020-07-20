<?php
use common\models\hotel\HotelRoom;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $model HotelRoom */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Бронирование номера / ' . Yii::$app->name;
$this->params['title'] = 'Бронирование номера';
$this->params['breadcrumbs'][] = 'Бронирование номера';
?>

<div class="container">
    <?php Pjax::begin(['id' => 'grid', 'timeout' => 4000]);?>
        <section class="g-pt-30--md g-pb-90">
            <div class="row">
                <div class="col-lg-3 g-mt-30 g-mb-50 g-mb-0--lg">
                    <?=$this->render('_filter', []);?>
                </div>
                <div class="col-lg-9 g-mt-30">
                    <?=ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_room_card.php',
                        'pager' => [
                            'options' => ['class' => 'list-inline text-center'],
                            'linkContainerOptions' => ['class' => 'list-inline-item'],
                            'linkOptions' => ['class' => 'u-pagination-v1__item u-pagination-v1-2 u-pagination-v1-2 g-pa-12-19'],
                            'activePageCssClass' => 'u-pagination-v1__item u-pagination-v1-2 u-pagination-v1-2--active',
                            'disabledPageCssClass' => 'hidden',
                            'disabledListItemSubTagOptions' => ['tag' => 'button', 'class' => 'u-pagination-v1__item u-pagination-v1-2 u-pagination-v1-2 g-pa-12-19', 'disabled' => 'disabled'],
                        ],
                    ]);?>
                </div>
            </div>
        </section>
    <?php Pjax::end()?>
</div>


