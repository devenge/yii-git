<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>
    <?=$form->field($model, 'name')->label('Имя')?>
    <?=$form->field($model, 'email')?>
    <?= Html::submitButton('Отправить') ?>
<?php ActiveForm::end(); ?>

<?php
foreach ($pages as $page) {
    echo $page->title;
};
