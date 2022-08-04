<?php
// view для создания новой заявки

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Application */
/* @var $e_model app\models\Equipment */

$this->title = 'Создать заявку';
$this->params['breadcrumbs'][] = ['label' => 'Реестр заявок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->breakdown_date = date('d.m.Y');
$model->repair_period = date('d.m.Y', strtotime('+3 days'));

?>
<div class="application-create">

    <h1 class="text-center pb-2"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'e_model' => $e_model,
    ]) // Тут рендерится форма с полями?>

</div>
