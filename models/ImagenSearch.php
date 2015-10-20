<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Imagen;

/**
 * ImagenSearch represents the model behind the search form about `app\models\Imagen`.
 */
class ImagenSearch extends Imagen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_carpeta'], 'integer'],
            [['dir'], 'safe'],
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
        $query = Imagen::find();

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
            'id_carpeta' => $this->id_carpeta,
        ]);

        $query->andFilterWhere(['like', 'dir', $this->dir]);

        return $dataProvider;
    }
}
