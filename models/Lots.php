<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lots".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property int $product_id
 * @property string|null $row
 * @property string|null $coordinates
 * @property string|null $weather
 * @property string $lot_number
 * @property int $quantity
 * @property string|null $date
 *
 * @property Products $product
 * @property LotsHash[] $lotsHashes
 */
class Lots extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lots';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'product_id', 'lot_number', 'quantity'], 'required'],
            [['description', 'weather'], 'string'],
            [['product_id', 'quantity'], 'integer'],
            [['date'], 'safe'],
            [['date'], 'default', 'value' => null],
            [['title', 'tags', 'row', 'coordinates', 'lot_number'], 'string', 'max' => 512],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'tags' => Yii::t('app', 'Tags'),
            'product_id' => Yii::t('app', 'Product ID'),
            'row' => Yii::t('app', 'Row'),
            'coordinates' => Yii::t('app', 'Coordinates'),
            'weather' => Yii::t('app', 'Weather'),
            'lot_number' => Yii::t('app', 'Lot Number'),
            'quantity' => Yii::t('app', 'Quantity'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ProductsQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[LotsHashes]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\LotsHashQuery
     */
    public function getLotsHashes()
    {
        return $this->hasMany(LotsHash::className(), ['lot_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\LotsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LotsQuery(get_called_class());
    }
}
