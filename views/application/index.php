<?php

// view для таблицы со списком заявок

use app\models\Application;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Реестр заявок';
$this->params['breadcrumbs'][] = $this->title;

// будущие колонки
use kartik\export\ExportMenu;
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'equipment.name',
    'equipment.model',
    'equipment.year',
    'equipment.serno',
    'equipment.invno',
    'problem:ntext',
    'status.name',
    'structure.name',
    'place:ntext',
    'breakdown_date',
    'repair_period',
    [
        'class' => ActionColumn::className(),
        'urlCreator' => function ($action, Application $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        }
    ],
];
// будущие кнопки для экспорта отчета
$export_menu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'clearBuffers' => true, //optional
    'showConfirmAlert' => false,
    'filename' => 'Отчёт по заявкам (' . date('d.m.Y') . ')',
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
?>
<div class="application-index">

    <h1 class="text-center pb-2"><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'summary' => '',
        'options' => ['style' => 'font-size:12px;'],

        'columns' => $gridColumns
    ]); // виджет для таблицы с заявками?>

    <?php Pjax::end(); ?>
    <div class="row justify-content-center align-items-center">
        <div class="">
            <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-outline-success']) ?>
        </div>
        <div class="pl-1">
            <?= $export_menu // вывод виджета для экспорта ?>
        </div>

    </div>

</div>
