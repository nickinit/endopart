<?php

// view для создания файла. тут задаются заголовки, "хлебные крошки"

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */

$this->title = 'Добавить оборудование';
$this->params['breadcrumbs'][] = ['label' => 'Реестр оборудования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-create">

    <h1 class="text-center pb-2"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
