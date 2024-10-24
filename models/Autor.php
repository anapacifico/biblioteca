<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "autor".
 *
 * @property int $id
 * @property string $nome
 * @property int $idade
 * @property string $genero
 * @property string $datanascimento
 * @property int|null $pais_id 
*
* @property Livro[] $livros
* @property Pais $pais 
*/

class Autor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'autor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'idade', 'genero', 'datanascimento'], 'required'],
            [['idade',  'pais_id'], 'integer'],
            [['datanascimento'], 'safe'],
            [['nome'], 'string', 'max' => 100],
            [['genero'], 'string', 'max' => 1],
            [['pais_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::class, 'targetAttribute' => ['pais_id' => 'id']],



        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $temp = explode('/', $this->datanascimento);
            $this->datanascimento = $temp[2]. '-' . $temp[1] .'-' . $temp[0];
            return true;
        }
        return false;
    }
     
    public function afterFind()
    {
        $this->datanascimento=str_replace(" 00:00:00", "", $this->datanascimento);
        $temp = explode ("-", $this->datanascimento);
        $this->datanascimento= $temp[2] . '/'. $temp [1] . '/'. $temp[0]; 
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'idade' => 'Idade',
            'genero' => 'Gênero',
            'datanascimento' => 'Data de Nascimento',
            'pais_id' => "Nacionalidade", 
        ];
    }

       
    /**
     * Gets query for [[Livros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLivros()
    {
        return $this->hasMany(Livro::class, ['autor_id' => 'id']);
    }

    /**
     * Gets query for [[Pais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(Pais::class, ['id' => 'pais_id']);
    }
}
