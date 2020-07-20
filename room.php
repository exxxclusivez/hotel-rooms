<?php

use common\models\hotel\HotelRoom;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model HotelRoom */

$this->title = 'Справочник номера / ' . Yii::$app->name;
$this->params['title'] = 'Справочник номера';
$this->params['breadcrumbs'][] = ['label' => 'Справочник номеров', 'url' => ['rooms']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? 'Добавить' : 'Редактировать';
$this->params['backButton'] = ['/hotel-rooms/rooms'];
?>

<div class="wrapper wrapper-content">
    <div class="animated fadeInRight">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li><a class="nav-link active" data-toggle="tab" href="#g-tab-1">Основная информация</a></li>
            </ul>
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                <?php $form = ActiveForm::begin([
                    'options' => [],
                    'encodeErrorSummary' => false,
                    'errorSummaryCssClass' => 'alert alert-danger',

                ]); ?>
                <div class="tab-content">
                    <div class="tab-pane active" id="index-tab">
                        <?=$form->errorSummary($model);?>
                        <?php if (Yii::$app->session->hasFlash('success')):?>
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?=Yii::$app->session->getFlash('success');?>
                            </div>
                        <?php endif;?>

                        <div class="row">
                            <div class="col-lg">
                                <?=$form->field($model, 'title')->textInput();?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <?=$form->field($model, 'description')->textarea();?>
                            </div>
                        </div>
                        <div class="text-right p-sm">
                            <?=Html::a('Создать новый номер', ['room'], ['class' => 'btn btn-white']);?>
                            <button class="btn btn-primary" type="submit"><?=$model->isNewRecord ? 'Добавить запись' : 'Сохранить изменения';?></button>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end();?>
            </div>
            </div>
        </div>
    </div>
</div>
