<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbooks */

$this->title = 'Create Borrowedbooks';
$this->params['breadcrumbs'][] = ['label' => 'Borrowedbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowedbooks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
