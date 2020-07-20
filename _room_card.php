<?php

use common\models\hotel\HotelRoom;
use yii\helpers\Url;

/* @var $model HotelRoom */
?>
<ul class="list-unstyled">
    <li class="u-block-hover u-shadow-v37 g-bg-secondary-dark-v1 g-bg-white rounded g-px-50 g-py-30 mb-4">
        <div class="row align-items-lg-center">
            <div class="col-md-10 col-lg-9 g-mb-30 g-mb-0--lg">
                <h3 class="h5 g-font-primary g-font-weight-500 mb-1"><?=$model->title?></h3>
                <span class="d-inline-block u-link-v5 g-color-text-light-v1">
                   <?=$model->description?>
                </span>
            </div>
            <div class="col-lg-3">
                <a class="btn btn-md btn-block u-btn-outline-primary g-mb-15 justify-content-center" href="<?=Url::to(['order', 'id' => $model->id])?>">Забронировать</a>
            </div>
        </div>
    </li>
</ul>