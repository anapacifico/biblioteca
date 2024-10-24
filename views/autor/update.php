<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Autor $model */

$this->title = 'Editar Autor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Autor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="autor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
