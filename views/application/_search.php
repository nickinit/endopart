<?php
// view для поиска оборудованмя по серийнику

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicationSearch */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(<<<JS
$('#search-form').on('focusout', function(e) {
  this.submit();
})
JS
);

?>

<div class="application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'id' => 'search-form',
        ],
    ]); ?>

    <?= $form->field($model, 'serno')->textInput(['class' => 'form-control col-4', 'placeholder' => 'Поиск']) ?>

    <?php ActiveForm::end(); ?>

</div>
