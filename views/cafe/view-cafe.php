<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


<h1><?= $cafe->name ?></h1>
<p>Адрес: <?= $cafe->address ?></p>
<p>Ориентир: <?= $cafe->landmark ?></p>
<p>Кухня: <?= $cafe->cuisine ?></p>
<p>Расстояние: <?= $cafe->distance ?> м</p>
<p>Время до кафе: <?= $cafe->time ?> мин</p>
<p>Фото: <img src="<?= $cafe->photo ?>" alt="<?= $cafe->name ?>"></p>
<p>Бизнес-ланч: <?= $cafe->business_lunch ? 'Да' : 'Нет' ?></p>
<p>Средняя цена: <?= $cafe->price ?> руб</p>

<h3>Оставьте комментарий:</h3>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($commentModel, 'text')->textarea(['rows' => 6]) ?>
    <?= $form->field($commentModel, 'id_cafe')->hiddenInput(['value' => $cafe->id])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

<!-- <h1><?php echo $cafe->name; ?></h1>
<p>Адрес: <?php echo $cafe->address; ?></p>
<p>Ориентир: <?php echo $cafe->landmark; ?></p>
<p>Кухня: <?php echo $cafe->cuisine; ?></p>
<p>Расстояние: <?php echo $cafe->distance; ?> м</p>
<p>Время до кафе: <?php echo $cafe->time; ?> мин</p>
<p>Фото: <img src="<?php echo $cafe->photo; ?>" alt="<?php echo $cafe->name; ?>"></p>
<p>Бизнес-ланч: <?php echo $cafe->business_lunch ? 'Да' : 'Нет'; ?></p>
<p>Средняя цена: <?php echo $cafe->price; ?> руб</p> -->
