<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Emprestimo;

/**
 * EmprestimoSearch represents the model behind the search form of `app\models\Emprestimo`.
 */
class EmprestimoSearch extends Emprestimo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'livro_id', 'pessoa_id', 'dias', 'status_emprestimo_id'], 'integer'],
            [['data_emprestimo'], 'safe'],
            [['taxa'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Emprestimo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            // 'id' => $this->id,
            // 'livro_id' => $this->livro_id,
            // 'pessoa_id' => $this->pessoa_id,
            // 'status_emprestimo_id' => $this->status_emprestimo_id,
            // 'data_devolucao' => $this->data_devolucao,
            // 'data_emprestimo' => $this->data_emprestimo,

            // 'data_emprestimo' => $this->data_emprestimo,
            // 'dias' => $this->dias,
            // 'taxa' => $this->taxa,
        ]);

        return $dataProvider;
    }
}
