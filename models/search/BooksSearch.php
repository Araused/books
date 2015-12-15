<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form about `app\models\Books`.
 */
class BooksSearch extends Books
{
    public $dateStart;
    public $dateEnd;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['name', 'dateStart', 'dateEnd'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'dateStart' => 'Дата выхода, с',
            'dateEnd' => 'Дата выхода, по',
        ]);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Books::find()->joinWith('author');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['author_id' => $this->author_id]);
        $query->andFilterWhere(['like', 'name', $this->name]);

        if (!empty($this->dateStart)) {
            $query->andFilterWhere(['>=', 'date', $this->dateStart]);
        }
        if (!empty($this->dateEnd)) {
            $query->andFilterWhere(['<=', 'date', $this->dateEnd]);
        }

        return $dataProvider;
    }
}
