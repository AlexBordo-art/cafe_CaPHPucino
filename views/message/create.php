<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Create Message</h1>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'id_cafe')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>
