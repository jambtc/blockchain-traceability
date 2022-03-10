<?php

namespace app\models;

use Imagine\Image\Box;
use Yii;
// use yii\behaviors\BlameableBehavior;
// use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\imagine\Image;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $picture_id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property string|null $file_name
 * @property int|null $status
 * @property int $component1_id
 * @property int|null $component2_id
 * @property int|null $component3_id
 *
 * @property Components $component1
 * @property Components $component2
 * @property Components $component3
 */
class Products extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @var \yii\web\UploadedFile
     */
    public $picture;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['picture_id', 'title'], 'required'],
            [['description'], 'string'],
            [['status', 'component1_id', 'component2_id', 'component3_id'], 'integer'],
            [['picture_id'], 'string', 'max' => 16],
            [['title', 'tags', 'file_name'], 'string', 'max' => 512],
            [['picture_id'], 'unique'],
            ['picture', 'image', 'minWidth' => 64],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['component1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Components::className(), 'targetAttribute' => ['component1_id' => 'id']],
            [['component2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Components::className(), 'targetAttribute' => ['component2_id' => 'id']],
            [['component3_id'], 'exist', 'skipOnError' => true, 'targetClass' => Components::className(), 'targetAttribute' => ['component3_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'picture_id' => Yii::t('app', 'Picture ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'tags' => Yii::t('app', 'Tags'),
            'file_name' => Yii::t('app', 'File Name'),
            'status' => Yii::t('app', 'Status'),
            'component1_id' => Yii::t('app', 'Component1 ID'),
            'component2_id' => Yii::t('app', 'Component2 ID'),
            'component3_id' => Yii::t('app', 'Component3 ID'),
        ];
    }

    /**
     * Gets query for [[Component1]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ComponentsQuery
     */
    public function getComponent1()
    {
        return $this->hasOne(Components::className(), ['id' => 'component1_id']);
    }

    /**
     * Gets query for [[Component2]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ComponentsQuery
     */
    public function getComponent2()
    {
        return $this->hasOne(Components::className(), ['id' => 'component2_id']);
    }

    /**
     * Gets query for [[Component3]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ComponentsQuery
     */
    public function getComponent3()
    {
        return $this->hasOne(Components::className(), ['id' => 'component3_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ProductsQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $isInsert = $this->isNewRecord;
        if ($isInsert){
            $this->picture_id = Yii::$app->security->generateRandomString(16);
            $this->title = $this->picture->name;
            $this->file_name = $this->picture->name;
        }
        $saved = parent::save($runValidation, $attributeNames);
        if (!$saved){
            return false;
        }

        if ($isInsert){
            $picturePath = Yii::getAlias('@webroot/storage/products/'.$this->picture_id.'.jpg');

            if (!is_dir(dirname($picturePath))){
                FileHelper::createDirectory(dirname($picturePath));
            }
            $this->picture->saveAs($picturePath);
            Image::getImagine()
                ->open($picturePath)
                ->thumbnail(new Box(1280,1280))
                ->save();
        }

        return true;
    }

    public function getPictureLink()
    {
        return 'storage/products/' . $this->picture_id .'.jpg';
    }

    public function getComponentLink($id)
    {
        return 'storage/components/' . $id .'.jpg';
    }

    public function getStatusLabels()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app','Enabled'),
            self::STATUS_DISABLED => Yii::t('app','Disabled'),
        ];
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $picturePath = Yii::getAlias('@webroot/storage/products/'.$this->picture_id.'.jpg');
        if (file_exists($picturePath)){
            unlink($picturePath);
        }

    }
}
