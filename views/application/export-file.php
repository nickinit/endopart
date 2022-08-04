<?php

// view для экспорта отчета

use phpnt\exportFile\ExportFile;
use yii\grid\GridView;
/* @var $searchModel app\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo ExportFile::widget([
'model'             => 'app\models\ApplicationSearch',   // путь к модели
'searchAttributes'  => $searchModel,                    // фильтр
])
 ?>

<?= GridView::widget([
    'dataProvider'  => $dataProvider,
    'filterModel'   => $searchModel,
    'columns' => [
        'problem'
    ]
]);
?>