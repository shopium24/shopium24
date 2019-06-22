<?php

namespace app\modules\hosting\models;

use Yii;
use yii\base\Model;
use panix\engine\data\ActiveDataProvider;

/**
 * PagesSearch represents the model behind the search form about `app\modules\pages\models\Pages`.
 */
class AccountSearch extends Account
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'login', 'token', 'account'], 'string'],
            [['name', 'login', 'token', 'account'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Account::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => self::getSort(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'token', $this->token]);
        $query->andFilterWhere(['like', 'account', $this->account]);

        return $dataProvider;
    }

    public static function getSort()
    {
        $sort = new \yii\data\Sort([
            'attributes' => [
                'date_create',
                'date_update',
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                ],
            ],
        ]);
        return $sort;
    }
}
