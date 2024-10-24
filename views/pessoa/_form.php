<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var app\models\Pessoa $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="pessoa-form">
    

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
 
    <?= $form->field($model, 'cpf')->widget(MaskedInput::class, [
    'mask' => '999.999.999-99',  ]) ?>

    
    <?= $form->field($model, 'endereco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contato')->widget(MaskedInput::class, [
    'mask' => '(99) 9 9999-9999',  ]) ?>
                                 

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
