<?php

// view, который будет использоваться отображения ошибки

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->registerCss(
        <<<CSS
.site-error {
padding-top: 100px;
}
CSS

);

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        При обработке вашего запроса сервером произошла ошибка.
    </p>


</div>
