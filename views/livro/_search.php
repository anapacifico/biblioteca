<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LivroSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="livro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'arquivo') ?>

    <?= $form->field($model, 'autor_id') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'genero_textual') ?>

    <?= $form->field($model, 'paginas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
