<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login custom-login-page d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 15px;">

        <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

        <p class="text-center text-muted">Por favor faça seu login:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control form-control-lg rounded-pill'],
                'errorOptions' => ['class' => 'invalid-feedback'],
            ],
        ]); ?>

        <div class="mb-3">
            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Usuário', 'autofocus' => true]) ?>
        </div>

        <div class="mb-3">
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Senha']) ?>
        </div>

        <div class="form-check mb-3">
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "{input} {label}\n<div>{error}</div>",
                'class' => 'form-check-input',
            ]) ?>
        </div>

        <div class="text-center">
            <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-lg btn-block rounded-pill', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

      <div class="mt-3 text-muted text-center">
          
        </div>

    </div>
</div>
