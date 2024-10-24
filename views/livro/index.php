<?php

use app\models\Livro;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LivroSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Livros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="livro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cadastre Livro', ['create'], ['class' => 'btn btn-success']) ?>
    
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'autor_id',
                'value' => function($model) {
                    return $model->autor->nome;
                }
            ],
            'titulo',
            'genero_textual',
            'paginas',
            'capitulos',
            [
                'attribute' => 'categoria_id',
                'value' => function($model) {
                    return $model->categoria?->descricao;
                }
            ],
            [
                'attribute' => 'ranking',
                'format' => 'html',
                'value' => function ($model) {
                    $stars = '';
                    for ($i=0; $i < $model->ranking; $i++) { 
                        $stars .= '★';
                    }
                   return '<div class="star">' . $stars . '</div>(' . $model->ranking . ')';
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Livro $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
