<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'preview',
                'format' => 'html',
                'value' => function ($data) {
                    if ($data->previewUrl !== null) {
                        return Html::img($data->previewUrl, [
                            'class' => 'book-img',
                            'title' => 'Нажмите для изменения размера',
                        ]);
                    }
                    return null;
                },
            ],
            [
                'attribute' => 'author_id',
                'value' => function ($data) {
                    return $data->author->fullName;
                },
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d.m.Y'],
            ],
            [
                'attribute' => 'date_create',
                'format' => ['date', 'php:d.m.Y'],
            ],

            [
                'class' => ActionColumn::className(),
                'header' => 'Действия',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                       return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                           'class' => 'view-book',
                           'data-toggle' => 'modal',
                           'data-target' => '#view-book-modal',
                       ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                           'target' => '_blank',
                       ]);
                    }
                ],
            ],
        ],
    ]); ?>
    
    <?php Modal::begin([
        'id' => 'view-book-modal',
        'header' => 'View',
        'size' => 'modal-lg',
    ]); ?>
    <div id="book-info"></div>
    <?php Modal::end(); ?>

</div>
