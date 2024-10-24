<?php

use app\models\Pessoa;
use app\models\StatusEmprestimo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Emprestimo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="emprestimo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pessoa_id')->dropDownList(
        ArrayHelper::map(Pessoa::find()->orderBy(['nome' => SORT_ASC])->all(), 'id', 'nome'),
        ['prompt' => 'Selecione um associado...']
    ) ?>

    <?= $form->field($model, 'dias')->textInput() ?>

    <?= ($model->id != null) ? $form->field($model, 'status_emprestimo_id')->dropDownList(
        ArrayHelper::map(StatusEmprestimo::find()->orderBy(['descricao' => SORT_ASC])->all(), 'id', 'descricao'),
        ['prompt' => 'Selecione o status...']
    ) : null; ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
