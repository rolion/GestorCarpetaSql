<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $nickname
 * @property integer $id
 * @property string $password
 * @property integer $id_perfil
 *
 * @property Perfil $idPerfil
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nickname', 'password'], 'required'],
            [['id_perfil'], 'integer'],
            [['nickname'], 'string', 'max' => 150],
            [['password'], 'string', 'max' => 10],
            [['nickname'], 'unique'],
            [['id_perfil'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_perfil' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nickname' => 'Nickname',
            'id' => 'ID',
            'password' => 'Password',
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
}
