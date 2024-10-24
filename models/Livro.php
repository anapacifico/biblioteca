<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "livro".
 *
 * @property int $id
 * @property int $autor_id
 * @property string $titulo
 * @property string $genero_textual
 * @property int $paginas
 * @property int $ranking
 * @property int $páginas
 * @property int $categoria_id
 *
 * @property Categoria $categoria
 * @property Autor $autor
 */
class Livro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'livro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['autor_id', 'titulo', 'genero_textual', 'paginas', 'ranking', 'capitulos'], 'required'],
            [['autor_id', 'paginas', 'capitulos', 'categoria_id'], 'integer'],
            ['ranking', 'integer', 'min' => 1, 'max' => 5],
            [['titulo'], 'string', 'max' => 45],
            [['genero_textual'], 'string', 'max' => 100],
            [['autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Autor::class, 'targetAttribute' => ['autor_id' => 'id']],
            ['ranking', 'integer', 'min' => 1, 'max' => 5],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoria_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'autor_id' => 'Autor',
            'titulo' => 'Titulo',
            'genero_textual' => 'Gênero textual',
            'paginas' => 'Número de páginas',
            'ranking' => 'Avaliação', 
            'capitulos' => 'Quantidade de cápitulos', 
            'categoria_id' => 'Categoria',
        ];
    }

    /**
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Autor::class, ['id' => 'autor_id']);
    }

    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'categoria_id']);
    }
}
