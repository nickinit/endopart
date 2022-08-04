<?php

use app\models\Structure;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\Models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $model->isNewRecord ? $form->field($model, 'username')->textInput() : '' ?>
    <?= $form->field($model, 'fullname')->textInput() ?>
    <?= $form->field($model, 'address')->textInput() ?>
    <?= $form->field($model, 'phone')->textInput() ?>
    <?= $form->field($model, 'structure_id')->dropDownList(
        ArrayHelper::map(Structure::find()->all(), 'id', 'name'), ['prompt' => '']
    ) ?>
    <?= $form->field($model, 'user_role')->dropDownList(
            ArrayHelper::map(Yii::$app->authManager->getRoles(),'name','description')
    ) ?>

    <?= $form->field($model, 'new_password')->passwordInput(['placeholder' => 'Скрыто']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-outline-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
