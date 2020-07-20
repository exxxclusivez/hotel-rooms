<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

    <div class="col-lg g-pr-40--lg g-mb-50 g-mb-0--lg">
        <h2 class="h5 text-uppercase g-color-gray-dark-v1">Категории</h2>
        <hr class="g-brd-gray-light-v4 g-my-15">
        <ul class="list-unstyled g-mb-40">
            <li class="my-3">
                <a class="d-flex justify-content-between u-link-v5 g-color-gray-dark-v1 g-parent" href="#">
                    Эконом <span class="d-inline-block g-font-size-12 g-min-width-40 g-brd-around g-color-gray-dark-v5 g-brd-gray-light-v3 text-center rounded g-px-10 g-py-3">99</span>
                </a>
            </li>
            <li class="my-3">
                <a class="d-flex justify-content-between u-link-v5 g-color-gray-dark-v1" href="#">
                    Бизнес <span class="d-inline-block g-font-size-12 g-min-width-40 g-brd-around g-color-gray-dark-v5 g-brd-gray-light-v3 g-bg-primary--parent-hover text-center rounded g-px-10 g-py-3">5</span>
                </a>
            </li>
        </ul>

        <!-- Result Types -->
        <h2 class="h5 text-uppercase g-color-gray-dark-v1">Удобства в номере</h2>
        <hr class="g-brd-gray-light-v4 g-my-15">
        <form>
            <div class="form-group g-mb-10">
                <label class="u-check g-pl-30">
                    <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                    <div class="u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                        <i class="fa" data-check-icon=""></i>
                    </div>
                    Кондиционер
                </label>
            </div>
            <div class="form-group g-mb-10">
                <label class="u-check g-pl-30">
                    <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" checked="">
                    <div class="u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                        <i class="fa" data-check-icon=""></i>
                    </div>
                    Стиральная машина
                </label>
            </div>
            <div class="form-group g-mb-10">
                <label class="u-check g-pl-30">
                    <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                    <div class="u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                        <i class="fa" data-check-icon=""></i>
                    </div>
                    Ванна
                </label>
            </div>
            <div class="form-group g-mb-10">
                <label class="u-check g-pl-30">
                    <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                    <div class="u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                        <i class="fa" data-check-icon=""></i>
                    </div>
                    Балкон
                </label>
            </div>
            <div class="form-group g-mb-10">
                <label class="u-check g-pl-30">
                    <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                    <div class="u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                        <i class="fa" data-check-icon=""></i>
                    </div>
                    Минибар
                </label>
            </div>
        </form>
    </div>