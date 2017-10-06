<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>

        <div id="msg" class="msg"></div>
    </div>
</div>



<?php $this->endBody() ?>
<script>
var msg = $("#msg");
$("#generate-url").click(function(e){
    e.preventDefault();

    msg.css("display", "none");

    var ajax = $.ajax({
        type: 'POST',
        url: '/',
        data: $("#add-link").serialize()
    });

    ajax.done(function(data) {
        msg.css("display", "block");
        if (0 === Number(data.error)) {
            msg.html("Ссылка сохранена по адресу " + location.href + "?url=" + data.short);
        } else {
            msg.html("Не удалось сохранить, скорее всего введена не ссылка или данная ссылка уже сохранена");
        }
    });
});
</script>
</body>
</html>
<?php $this->endPage() ?>
