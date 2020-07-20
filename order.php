<?php
use common\models\hotel\HotelRoom;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model HotelRoom */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Оформление заказа / ' . Yii::$app->name;
$this->params['title'] = 'Оформление заказа';
$this->params['breadcrumbs'][] = ['label' => 'Бронирование номера', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Оформление заказа';
?>

<div class="container g-pt-30 g-pb-40">
    <div class="row g-mb-30">
        <div class="col-lg-8 g-mb-30">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase g-font-weight-300 g-font-size-15 g-py-20">Название</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle g-py-20">
                                <div class="g-mb-5 g-line-height-1_3"><?=$model->title?></div>
                                <div class="text-muted g-font-size-13"><?=$model->description?></div>
                            </td>
                            <td class="align-middle g-py-20">
                                <div class="g-font-weight-600 g-font-size-15 g-color-black text-nowrap">14 400 <i class="fa fa-rub g-font-size-13"></i></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4 g-mb-30">
            <div class="g-bg-gray-light-v4 g-pa-15 g-mb-20">
                <div class="d-flex align-items-center flex-wrap g-line-height-1_3">
                    <div class="text-uppercase g-font-weight-600 g-font-size-15 g-my-5 g-mx-10">Итого</div>
                </div>
                <hr class="g-brd-gray-light-v2 g-my-8">

                <div class="g-py-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="g-mx-10 g-my-3">К оплате:</div>
                        <div class="g-mx-10 g-my-3 g-font-weight-700">14 400 ₽</div>
                    </div>
                </div>
            </div>
            <form method="post" id="order-form" class="ajax-submit-json" data-output="#order-output" action="<?=Url::to(['ajax-order-submit', 'id' => $model->id]);?>">
                <div id="order-output"></div>
                <div class="g-mb-15">
                    <?=Html::textInput('HotelRoomOrder[client_name]', null,  ['class' => 'form-control form-control-md', 'id' => 'order-client-name', 'placeholder' => 'Введите имя'])?>
                </div>

                <div class="g-mb-15">
                    <?=Html::textInput('HotelRoomOrder[client_mobile]', null,  ['class' => 'form-control form-control-md', 'id' => 'order-client-name', 'placeholder' => 'Введите мобильный'])?>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?=Html::textInput('HotelRoomOrder[arrival_date]', null,  ['class' => 'form-control form-control-md', 'id' => 'order-arrival-date', 'placeholder' => 'Дата заезда'])?>
                    </div>
                    <div class="col-lg-6">
                        <?=Html::textInput('HotelRoomOrder[departure_date]', null,  ['class' => 'form-control form-control-md', 'id' => 'order-departure-date', 'placeholder' => 'Дата выезда'])?>
                    </div>
                    <?=Html::hiddenInput('HotelRoomOrder[hotel_room_id]', $model->id)?>
                </div>
                <button type="submit" class="btn btn-md btn-block u-btn-hover-v1-1 text-uppercase u-btn-primary g-mt-25">Оформить заказ</button>
            </form>
        </div>
    </div>
</div>

<?php
$this->registerJs('
 $(".ajax-submit-json").off().on("submit", function(e) {
        e.preventDefault();
        $(this).ajaxSubmit({
            dataType: "json",
            beforeSubmit: function(formData, $form, options) {
                var $target = $($(e.target).data("output"));
                $target.html("<i class=\'fa fa-spin fa-spinner\'></i> отправляю на сервер");
            },
            success: function(resp, statusText, xhr, $form) {
                var $target = $($(e.target).data("output"));
                var $success = $(e.target).data("");
                if (resp.error == 0)  {
                    if (\'pjax\' in  resp) {
                        $.pjax.reload(resp.pjax);
                    }
                    if (resp.reset_form == 1) {
                        $form.resetForm();
                    }
                    $target.html("<span class=\'\'><i class=\'fa fa-check\'></i> " + resp.msg + "</span>").attr("class", "alert alert-success");
                    if ($form.hasAttr("data-success")) {
                        eval($form.attr("data-success"));
                    }
                } else {
                    $target.html("<span class=\'text-danger\'>" + resp.msg + "</span>").attr("class", "alert alert-danger");
                }
            },
            complete: function (resp) {
                //$(e.target).removeClass("sk-loading");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#system-error").show().html("<span class=\'text-error\'>Произошла системная ошибка # " + jqXHR.status + ": " + jqXHR.responseText + "</span> ");
            }
        });
    });
');