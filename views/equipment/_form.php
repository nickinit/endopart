<?php

// view формы

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(); // начало формы ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col">

            <?= $form->field($model, 'year')->textInput() ?>
        </div>
        <div class="col">

        <?= $form->field($model, 'invno')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">

        <?= $form->field($model, 'serno')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group justify-content-center align-items-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-outline-success']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end();  // конец формы ?>

</div>
