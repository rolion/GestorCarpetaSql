<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagen".
 *
 * @property integer $id
 * @property string $dir
 * @property integer $id_carpeta
 *
 * @property Carpeta $idCarpeta
 */
class Imagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imagen;
    public static function tableName()
    {
        return 'imagen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dir', 'id_carpeta'], 'required'],
            [['id', 'id_carpeta'], 'integer'],
            [['dir'], 'string', 'max' => 255],
            [['imagen'],'file','extensions'=>'jpg, png'],
            [['id_carpeta'], 'exist', 'skipOnError' => true, 'targetClass' => Carpeta::className(), 'targetAttribute' => ['id_carpeta' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dir' => 'Dir',
            'id_carpeta' => 'Id Carpeta',
            'imagen'=>'Imagen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarpeta()
    {
        return $this->hasOne(Carpeta::className(), ['id' => 'id_carpeta']);
    }
}
