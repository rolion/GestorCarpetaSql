<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carpeta".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $id_perfil
 *
 * @property Perfil $idPerfil
 * @property Imagen[] $imagens
 */
class Carpeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carpeta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'nombre'], 'required'],
            [['id', 'id_perfil'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['id_perfil'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_perfil' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'id_perfil' => 'Id Perfil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPerfil()
    {
        return $this->hasOne(Perfil::className(), ['id' => 'id_perfil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagen::className(), ['id_carpeta' => 'id']);
    }
}
