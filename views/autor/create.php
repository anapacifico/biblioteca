<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Autor $model */

$this->title = 'Cadastre o Autor';
$this->params['breadcrumbs'][] = ['label' => 'Autors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
