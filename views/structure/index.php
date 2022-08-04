<?php

use app\models\Structure;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Штатная структура';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="structure-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete}'

            ],
        ],
    ]); ?>

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-outline-success text-center']) ?>
            </div>
        </div>
    </div>

</div>
