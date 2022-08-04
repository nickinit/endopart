<?php

// view для обновления заявок

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Application */
/* @var $e_model app\models\Equipment */

$this->title = "Обновить заявку от {$model->breakdown_date} (#{$model->id})";
$this->params['breadcrumbs'][] = ['label' => 'Реестр заявок', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Заявка от {$model->breakdown_date} (#{$model->id})", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="application-update">

    <h1 class="text-center pb-2"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'e_model' => $e_model
    ]) // здесь рендерится форма. Она общая для создания и обновления заявки ?>

</div>
