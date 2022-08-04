<?php

use app\models\Status;
use app\models\Structure;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Application */
/* @var $e_model app\models\Equipment */
/* @var $form yii\widgets\ActiveForm */

$isNewRecord = ($model->isNewRecord ? 'true' : 'false');

// При уходе фокуса с поля серийный номер выполняется поиск оборудования
// соответствующим серийным номером
$this->registerJs(<<<JS
if ($isNewRecord === true) {
    $('#equipment-serno').on('focusout', function(e) {
        if ($(this).val() === '') {
            return true
        } 
        let validated = true; 
        let f = $('#w0');
        // $('#w0').yiiActiveForm('remove', 'yourinputID');
        // $('#w0').yiiActiveForm('validateAttribute', 'contactform-name');
        f.find('input').each(function(e) {
          if ($(this).attr('id') !== undefined) {
              if ($(this).val() === '') {
                  f.yiiActiveForm('remove', $(this).attr('id'));
              } else {
                  if (f.yiiActiveForm('validateAttribute', $(this).attr('id')) === false) {
                      validated = false;
                  }
                  
              }
              
          }
        });
        if (validated) {
            f.find('input').each(function(e) {
                if ($(this).attr('id') !== undefined) {
                    f.yiiActiveForm('remove', $(this).attr('id'));
                }
            })
        }
        $('#equipment-isnew').val($(this).val());
        f.submit();
        
    })}


JS
);

?>

<div class="application-form">

    <?php $form = ActiveForm::begin(); // Начало формы ?>

    <div class="row">
        <div class="col">

            <?= $form->field($e_model, 'serno')->textInput(['disabled' => Yii::$app->controller->action->id == 'create' ? false:true] ) ?>
            <?= $form->field($e_model, 'isNew')->hiddenInput()->label(false) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'problem')->textInput([]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($e_model, 'name')->textInput(['disabled' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'status_id')
                ->dropDownList(ArrayHelper::map(Status::find()->all(),'id', 'name'))
                ->label('Статус') ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($e_model, 'model')->textInput(['disabled' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'structure_id')->textInput(['maxlength' => true])
                ->dropDownList(ArrayHelper::map(Structure::find()->all(),'id', 'name'))
                ->label('Подразделение') ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($e_model, 'year')->textInput(['disabled' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'place')->textInput([]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($e_model, 'invno')->textInput(['disabled' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'breakdown_date')->widget('yii\jui\DatePicker', ([
                'dateFormat' => 'dd.MM.yyyy',
                'options' => [
                    'class' => 'form-control'
                ],
            ])) ?>
        </div>
    </div>
    <div class="row">

        <div class="offset-6 col">
            <?= $form->field($model, 'repair_period')->widget('yii\jui\DatePicker', ([
                'dateFormat' => 'dd.MM.yyyy',
                'options' => [
                    'class' => 'form-control'
                ],
            ])) ?>
        </div>
    </div>
    <?php if($model->attachment_path !== null): ?>
    <div class="row">
        <div class="offset-6 col">
            <span><?= $model->shortname ?></span>
            <?= Html::a('Скачать', ['download', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
            <?= Html::a('Удалить', ['delete-file', 'id' => $model->id], ['class' => 'btn btn-outline-danger']) ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="row pt-2">
        <div class="offset-6 col">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>
    </div>

    <div class="pt-2 form-group text-center col">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-outline-success']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-outline-secondary']) ?>
    </div>



    <?php ActiveForm::end(); // Конец формы ?>

</div>
