<?php

use yii\bootstrap4\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

// регистрация стиля для замены вида курсора для класса pointer
$this->registerCss( <<<CSS
    .pointer {
        cursor: pointer;
    }
    
CSS
);

$this->title = 'Администрирование';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1 class="text-center pb-2" ><?= Html::encode($this->title) ?></h1>

    <ul class="list-group col-4 pb-2">
        <li class="pointer list-group-item list-group-item-action list-group-item-default" onclick="location.href = '<?= Url::to('/structure/index') ?>'">Управление штатной структурой</li>
        <li class="pointer list-group-item list-group-item-action list-group-item-default" onclick="location.href = '<?= Url::to('/status/index') ?>'">Управление статусами ремонта</li>
    </ul>






    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'fullname',
            'address:ntext',
            'phone',
            'username',
            'structure.name',
//            'name',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
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

    <p>

    </p>

</div>
