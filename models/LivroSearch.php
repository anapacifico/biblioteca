<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Livro;

/**
 * LivroSearch represents the model behind the search form of `app\models\Livro`.
 */
class LivroSearch extends Livro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'paginas', 'ranking', 'capitulos', 'paginas'], 'integer'],
            [['titulo', 'genero_textual', 'autor_id', 'categoria_id'], 'safe'],
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
        $query = Livro::find();

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
            'id' => $this->id,
            // 'autor_id' => $this->autor_id,
            'paginas' => $this->paginas,
            'capitulos' => $this->capitulos,
            // 'categoria' => $this->categoria_id,
            'ranking' => $this-> ranking,   
        ]);


        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'genero_textual', $this->genero_textual]);

        if ($this->categoria_id != null) {
            $query->join('inner join', 'categoria c', 'c.id = categoria_id')
            ->andFilterWhere(['like', 'c.descricao', $this->categoria_id]);
        }

        if ($this->autor_id != null) {
            $query->join('inner join', 'autor a', 'a.id = autor_id')
            ->andFilterWhere(['like', 'a.nome', $this->autor_id]);
        }

        return $dataProvider;
    }
}
