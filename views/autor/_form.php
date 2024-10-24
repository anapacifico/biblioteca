<?php

use app\models\Pais;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/** @var yii\web\View $this */
/** @var app\models\Autor $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="autor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'idade')->textInput() ?>

    <?= $form->field($model, 'genero')->radioList(
[
    'F' => 'Feminino', 
    'M' => 'Masculino', 
    '0' => 'Não especificado'
],  
    ['itemOptions' => ['class' => 'radio-inline']] // Adiciona estilo inline aos botões
    );  ?>

    <div class="form-group">
   
    <?= $form->field($model, 'pais_id')->dropDownList(ArrayHelper::map(Pais::find()->all(), 'id', 'pais')) ?>

   <?= $form->field($model, 'datanascimento')->widget(\yii\widgets\MaskedInput::class, [
    'mask' => '99/99/9999',
]) ?>
 

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
