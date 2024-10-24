<?php

use app\models\Emprestimo;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Livro $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Livros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="livro-view">

<h2><?= $model->titulo; ?></h2>

    <p>
    <?= Html::a('Cadastre novo Livro', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Editar', ['Editar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['Apagar', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que deseja apagar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'autor_id',
            'titulo',
            'arquivo',
            'genero_textual',
            'paginas',
            'capitulos',
            'categoria_id',
            [
                'attribute' => 'ranking',
                'format' => 'html',
                'value' => function ($model) {
                    $stars = '';
                    for ($i=0; $i < $model->ranking; $i++) { 
                        $stars .= '★';
                    }
                   return '<div class="star">' . $stars . '</div>';
                }
            ]
        ],
    ]) ?>

</div>

<hr />

<div class="livro-emprestar">

    <h3>Registros de emprestimo de "<?= $model->titulo; ?>"</h3>

    <p>
        <?= Html::a('Emprestar', ['emprestimo/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= Alert::widget() ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderEmprestimos,
        // 'filterModel' => $searchModelEmprestimos ?? null,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'pessoa_id',
                'value' => function($model) {
                    return $model->pessoa->nome;
                }
            ],
            [
                'attribute' => 'data_emprestimo',
                'value' => function ($model) {
                    $date = new DateTime($model->data_emprestimo);
                    return $date->format('d/m/Y H:i:s');
                }
            ],
            'taxa',
            [
                'label' => 'Previsão de devolução',
                'value' => function ($model) {
                    $date = new DateTime($model->data_emprestimo);
                    $date->modify('+' . $model->dias . ' days');
                    return $date->format('d/m/Y H:i:s');
                }
            ],
            [
                'attribute' => 'status_emprestimo_id',
                'value' => function($model) {
                    return $model->statusEmprestimo->descricao;
                }
            ],
            [
                'attribute' => 'data_devolucao',
                'value' => function ($model) {
                    if ($model->data_devolucao != null) {
                        $date = new DateTime($model->data_devolucao);
                        return $date->format('d/m/Y H:i:s');
                    } else {
                        return null;
                    }
                }
            ],

            
            [
    'class' => ActionColumn::class,
    'template' => '{update}',
    'urlCreator' => function ($action, Emprestimo $model, $key, $index, $column) {
        return Url::toRoute(['emprestimo/' . $action, 'id' => $model->id]);
    }
],

        ],
    ]); ?>


</div>
