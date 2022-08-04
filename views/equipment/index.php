<?php

// view для отображения таблицы с оборудованием

use app\models\Equipment;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// Будущие колонки для отображения в виджете GridView
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

//            'id',
    'name',
    'model',
    'year',
    'invno',
    'serno',
    [
        'class' => ActionColumn::className(),
        'urlCreator' => function ($action, Equipment $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        }
    ],
];

// Настройка меню для экспорта отчета
$export_menu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'clearBuffers' => true, //optional
    'showConfirmAlert' => false,
    'filename' => 'Отчёт по оборудованию (' . date('d.m.Y') . ')',
    'template' => '<a id="w0-xlsx" class="btn btn-outline-info export-full-xlsx" href="#" data-format="Xlsx"><i class="text-success"></i>Сформировать отчёт</a>{columns}',
    'exportConfig' => [
        ExportMenu::FORMAT_EXCEL_X => [
            'label' => 'Сформировать отчёт',
            'linkOptions' => ['class' => 'btn btn-info'],
        ],
        ExportMenu::FORMAT_CSV => false,
        ExportMenu::FORMAT_EXCEL => false,
        ExportMenu::FORMAT_HTML => false,
        ExportMenu::FORMAT_PDF => false,
        ExportMenu::FORMAT_TEXT => false,
    ]
]);

$this->title = 'Реестр оборудования';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-index">

    <h1 class="text-center pb-2""><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'sorter' => false,
        'summary' => '',
        'columns' => $gridColumns,
    ]); // виджет для отображения списка оборудования ?>

    <div class="row justify-content-center align-items-center">
        <div class="">
            <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-outline-success']) ?>
        </div>
        <div class="pl-1">
            <?= $export_menu // отображение виджета экспорта отчета ?>
        </div>

    </div>


</div>
