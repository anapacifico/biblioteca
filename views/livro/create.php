<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Livro $model */

$this->title = 'Create Livro';
$this->params['breadcrumbs'][] = ['label' => 'Livros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Cadastre um livro">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
