<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
                            'class' => 'img-thumb img-responsive',
                            'style' => 'width: 80px;',
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
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
