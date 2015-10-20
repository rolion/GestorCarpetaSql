<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property integer $id
 * @property string $nombre_apellido
 * @property string $Pais
 * @property string $email
 *
 * @property Carpeta[] $carpetas
 * @property Usuario[] $usuarios
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nombre_apellido', 'email'], 'required'],
            [['id'], 'integer'],
            [['nombre_apellido', 'email'], 'string', 'max' => 255],
            [['Pais'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_apellido' => 'Nombre Apellido',
            'Pais' => 'Pais',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarpetas()
    {
        return $this->hasMany(Carpeta::className(), ['id_perfil' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['id_perfil' => 'id']);
    }
}
