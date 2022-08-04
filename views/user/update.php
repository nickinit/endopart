<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\Models\User */

$this->title = 'Изменить учётные данные: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
