<?php

// шаблон для всех страниц сайта

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
        'brandLabel' => '<img src="/logo.png" class="pull-left position-fixed" style="top:50px; left:5%"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-light bg-light fixed-top py-5  justify-content-center',
            'style' => 'margin-left:auto;margin-right:auto;'
//            'class' => 'navbar navbar-expand-md navbar-dark /*bg-dark*/ text-dark fixed-top ',
        ],
    ]);
//    var_dump(Yii::$app->user->can('user'), Yii::$app->user);die;
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav mx-auto', ],
        'items' => [
            ['label' => 'Реестр заявок', 'url' => ['/application/index']],
            ['label' => 'Новая заявка', 'url' => ['/application/create']],
            ['label' => 'Новое оборудование', 'url' => ['/equipment/create']],
            ['label' => 'Реестр оборудования', 'url' => ['/equipment/index']],
            ['label' => 'Администрирование', 'url' => ['/user/index'], 'visible' => Yii::$app->user->can('admin') ],
            Yii::$app->user->isGuest ? (
                '<li>'
                . Html::beginForm(['/site/login'], 'get', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Войти',
                    ['class' => 'btn btn-outline-secondary  pull-right position-fixed', 'style' => 'top:75px;right:5%']
                )
                . Html::endForm()
                . '</li>'
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-outline-secondary  pull-right position-fixed', 'style' => 'top:75px;right:5%']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container " >
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['style' => 'padding-top: 75px']
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; Эндопарт <?= (date('Y') == 2022 ? '': '2022 - ') . date('Y')?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
