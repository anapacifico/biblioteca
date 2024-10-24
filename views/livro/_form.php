<?php

use app\models\Autor;
use app\models\Categoria;
use app\models\Livro;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Livro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<style>
    
</style>

<div class="livro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categoria_id')->dropDownList(
    ArrayHelper::map(Categoria::find()->orderBy(['descricao' => SORT_ASC])->all(), 'id', 'descricao'),
    ['prompt' => 'Selecione...']
    )
    ?>

    <?= $form->field($model, 'arquivo')->fileInput() ?>

    <?= $form->field($model, 'autor_id')->dropDownList(
    ArrayHelper::map(Autor::find()->orderBy(['nome' => SORT_ASC])->all(), 'id', 'nome'),
    ['prompt' => 'Selecione um autor...']
) ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'genero_textual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paginas')->textInput() ?>

    <?= $form->field($model, 'capitulos')->textInput() ?>

    <div class="form-group">
        Avaliação: 
        <div class="star-rating">
            <input type="radio" id="sr-0-5" name="Livro[ranking]" value="5" <?= ($model->ranking == 5) ? 'checked' : ''; ?> />
            <label for="sr-0-5">★</label>
            <input type="radio" id="sr-0-4" name="Livro[ranking]" value="4" <?= ($model->ranking == 4) ? 'checked' : ''; ?> />
            <label for="sr-0-4">★</label>
            <input type="radio" id="sr-0-3" name="Livro[ranking]" value="3" <?= ($model->ranking == 3) ? 'checked' : ''; ?> />
            <label for="sr-0-3">★</label>
            <input type="radio" id="sr-0-2" name="Livro[ranking]" value="2" <?= ($model->ranking == 2) ? 'checked' : ''; ?> />
            <label for="sr-0-2">★</label>
            <input type="radio" id="sr-0-1" name="Livro[ranking]" value="1" <?= ($model->ranking == 1) ? 'checked' : ''; ?> />
            <label for="sr-0-1">★</label>

        </div>
    </div>
       
    </div>

    <div class="form-group" >
              <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
            </div>

        


    <?php ActiveForm::end();

    ?>



</div>  