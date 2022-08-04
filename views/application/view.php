<?php

// view для детального отображения заявки

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Application */

$this->title = "Заявка от {$model->breakdown_date} (#{$model->id})";
$this->params['breadcrumbs'][] = ['label' => 'Реестр заявок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-view">

    <h1 class="text-center pb-2"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'equipment.name',
            'equipment.model',
            'status.name',
            'structure.name',
            'problem:ntext',
            'place:ntext',
            'breakdown_date',
            'repair_period',
            'equipment.year',
            'equipment.invno',
            'equipment.serno',
            [
                'label' => 'Приложение',
                'format' => 'html',
                'value' => function($model) {
                    return ($model->shortname !== null ? Html::a($model->shortname,['download', 'id' => $model->id])  : null);
                }
            ],
        ],
    ]) // инициализация виджета для детального отображения с заданием настроек отображаемых полей ?>


</div>
