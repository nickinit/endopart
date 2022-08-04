<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Structure */

$this->title = 'Обновить сведения (' . $model->name . ')';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/user/index']];
$this->params['breadcrumbs'][] = ['label' => 'Штатная структура', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="structure-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
