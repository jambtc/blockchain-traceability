<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lots_hash".
 *
 * @property int $id
 * @property int $lot_id
 * @property string|null $hash
 * @property string|null $txhash
 *
 * @property Lots $lot
 */
class LotsHash extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lots_hash';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lot_id'], 'required'],
            [['lot_id'], 'integer'],
            [['hash', 'txhash'], 'string', 'max' => 512],
            [['lot_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lots::className(), 'targetAttribute' => ['lot_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lot_id' => Yii::t('app', 'Lot ID'),
            'hash' => Yii::t('app', 'Hash'),
            'txhash' => Yii::t('app', 'Txhash'),
        ];
    }

    /**
     * Gets query for [[Lot]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\LotsQuery
     */
    public function getLot()
    {
        return $this->hasOne(Lots::className(), ['id' => 'lot_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\LotsHashQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LotsHashQuery(get_called_class());
    }
}
