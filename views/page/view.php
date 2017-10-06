<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = $model->id;
?>
<div class="page-view">

    <p>Ссылка успешно сгенерирована и доступна по адресу: <a href="http://yii2.local/?url=<?=$model->alias?>">http://yii2.local/?url=<?=$model->alias?></a></p>

</div>
