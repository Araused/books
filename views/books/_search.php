<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Authors;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\search\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'author_id')->dropDownList(Authors::getAuthorsList(), ['prompt' => '']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'name') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'dateStart')->widget(DatePicker::className(), [
                'language' => 'ru',
                'type' => DatePicker::TYPE_INPUT,
                'options' => [
                    'class' => 'form-control',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'dateEnd')->widget(DatePicker::className(), [
                'language' => 'ru',
                'type' => DatePicker::TYPE_INPUT,
                'options' => [
                    'class' => 'form-control',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="text-right">
            <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
