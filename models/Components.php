<?php

namespace app\models;

use Imagine\Image\Box;
use Yii;
// use yii\behaviors\BlameableBehavior;
// use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\imagine\Image;

/**
 * This is the model class for table "components".
 *
 * @property int $id
 * @property string $picture_id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property string|null $file_name
 */
class Components extends \yii\db\ActiveRecord
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
        return 'components';
    }

    // public function behaviors()
    // {
    //     return [
    //         TimestampBehavior::class,
    //         [
    //             'class' => BlameableBehavior::class,
    //             'updatedByAttribute' => false
    //         ]
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['picture_id', 'title'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['picture_id'], 'string', 'max' => 16],
            [['title', 'tags', 'file_name'], 'string', 'max' => 512],
            [['picture_id'], 'unique'],
            ['picture', 'image', 'minWidth' => 64],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
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
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ComponentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ComponentsQuery(get_called_class());
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
            $picturePath = Yii::getAlias('@webroot/storage/components/'.$this->picture_id.'.jpg');

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
        return 'storage/components/' . $this->picture_id .'.jpg';
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

        $picturePath = Yii::getAlias('@webroot/storage/components/'.$this->picture_id.'.jpg');
        if (file_exists($picturePath)){
            unlink($picturePath);
        }

    }


}
