<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Emprestimo $model */

$this->title = 'Registrar emprestimo do livro "' . $model->livro->titulo . '"';
$this->params['breadcrumbs'][] = ['label' => 'Emprestimos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
