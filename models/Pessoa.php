<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa".
 *
 * @property int $id
 * @property string $nome
 * @property int $cpf
 * @property string $contato
 * @property string $endereco
 */
class Pessoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cpf', 'contato', 'endereco'], 'required'],
            [['cpf'], 'string', 'max' => 14],
            [['nome', 'contato', 'endereco'], 'string', 'max' => 45],
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->cpf != null) {
            $this->cpf = str_replace(['.','-'], '', $this->cpf);
        }
        if ($this->contato != null) {
            $this->contato = str_replace(['(',')',' ','-'], '', $this->contato);
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'contato' => 'Telefone de Contato',
            'endereco' => 'Endereço',
        ];
    }
}
