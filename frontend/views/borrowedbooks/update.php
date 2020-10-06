<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbooks */

$this->title = 'Update Borrowedbooks: ' . $model->bbId;
$this->params['breadcrumbs'][] = ['label' => 'Borrowedbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bbId, 'url' => ['view', 'id' => $model->bbId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borrowedbooks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
