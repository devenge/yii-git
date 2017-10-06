<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Генерация ссылок';


?>
<div class="page-create">

<?php 
$form = ActiveForm::begin([
    'id' => 'add-link',
]);
?>

<?= $form->field($model, 'url') ?>
<?= Html::submitButton('Сгенерировать', ['class' => 'btn btn-success', 'id' => 'generate-url']) ?>
    


<?php ActiveForm::end() ?>
</div>

