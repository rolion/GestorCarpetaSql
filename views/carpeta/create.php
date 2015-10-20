<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Carpeta */

$this->title = 'Create Carpeta';
$this->params['breadcrumbs'][] = ['label' => 'Carpetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carpeta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'imagen'=>$imagen,
    ]) ?>

</div>
