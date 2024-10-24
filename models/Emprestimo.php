<?php

namespace app\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "emprestimo".
 *
 * @property int $id
 * @property int $livro_id
 * @property int $pessoa_id
 * @property string $data_emprestimo
 * @property string|null $data_devolucao
 * @property int $dias
 * @property float|null $taxa
 * @property int $status_emprestimo_id
 *
 * @property Livro $livro
 * @property Pessoa $pessoa
 * @property StatusEmprestimo $statusEmprestimo
 */
class Emprestimo extends \yii\db\ActiveRecord
{
    public function __construct()
    {
        parent::__construct();
        $this->data_emprestimo = date('Y-m-d H:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emprestimo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['livro_id', 'pessoa_id', 'data_emprestimo', 'status_emprestimo_id'], 'required'],
            [['livro_id', 'pessoa_id', 'dias', 'status_emprestimo_id'], 'integer'],
            [['data_emprestimo'], 'safe'],
            [['taxa'], 'number'],
            [['data_devolucao'], 'string', 'max' => 45],
            [['livro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Livro::class, 'targetAttribute' => ['livro_id' => 'id']],
            [['pessoa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::class, 'targetAttribute' => ['pessoa_id' => 'id']],
            [['status_emprestimo_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusEmprestimo::class, 'targetAttribute' => ['status_emprestimo_id' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        $status = StatusEmprestimo::find()->where(['descricao' => 'Devolvido'])->one();
        if ($status != null) {
            if ($this->status_emprestimo_id == $status->id) {
                $multa_por_dia = 5.00;

                $this->data_devolucao = date('Y-m-d H:i:s');

                // Criar objeto DateTime com a data de empréstimo
                $dataEmprestimo = new DateTime($this->data_emprestimo);

                $dataPrevista = clone $dataEmprestimo; // Clonar para não modificar o objeto original
                $dataPrevista->modify('+' . $this->dias . ' days');

                // Criar objeto DateTime com a data de devolução
                $dataDevolucao = new DateTime($this->data_devolucao);


                // Verificar se a data de devolução passou da data prevista
                if ($dataDevolucao > $dataPrevista) {
                    // Calcular a diferença entre as datas
                    $intervalo = $dataPrevista->diff($dataDevolucao);

                    // Número de dias de atraso
                    $diasDeAtraso = $intervalo->days;

                    // Calcular a multa
                    $this->taxa = $diasDeAtraso * $multa_por_dia;
                }
            }
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'livro_id' => 'Nome do livro',
            'pessoa_id' => 'Associado',
            'data_emprestimo' => 'Data de emprestimo',
            'data_devolucao' => 'Data de devolucao',
            'dias' => 'Dias de emprestimo',
            'taxa' => 'Taxa',
            'status_emprestimo_id' => 'Status',
        ];
    }

    /**
     * Gets query for [[Livro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLivro()
    {
        return $this->hasOne(Livro::class, ['id' => 'livro_id']);
    }

    /**
     * Gets query for [[Pessoa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPessoa()
    {
        return $this->hasOne(Pessoa::class, ['id' => 'pessoa_id']);
    }

    /**
     * Gets query for [[StatusEmprestimo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusEmprestimo()
    {
        return $this->hasOne(StatusEmprestimo::class, ['id' => 'status_emprestimo_id']);
    }
}
