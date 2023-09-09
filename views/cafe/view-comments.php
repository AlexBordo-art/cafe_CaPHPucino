<?php
/* @var $this yii\web\View */
/* @var $comments app\models\Comment[] */

$this->title = 'View Comments';
?>

<h1><?= Html::encode($this->title) ?></h1>

<ul>
    <?php foreach ($comments as $comment): ?>
        <li><?= Html::encode($comment->text) ?></li>
    <?php endforeach; ?>
</ul>
