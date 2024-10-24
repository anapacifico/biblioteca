<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_emprestimo".
 *
 * @property int $id
 * @property string $descricao
 *
 * @property Emprestimo[] $emprestimos
 */
class StatusEmprestimo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_emprestimo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'descricao',
        ];
    }

    /**
     * Gets query for [[Emprestimos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmprestimos()
    {
        return $this->hasMany(Emprestimo::class, ['status_emprestimo_id' => 'id']);
    }
}
