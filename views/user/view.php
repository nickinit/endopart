<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\Models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'fullname',
            'address:ntext',
            'phone',
            'username',
            'structure.name',
            [
              'label' => 'Права',
              'value' => function ($model) {
                 return Yii::$app->authManager->getRole($model->user_role)->description;
              }
            ],
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
//            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
