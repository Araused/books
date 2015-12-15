<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%books}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    protected $previewDir = '@web/img';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%books}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_create', 'date'], 'required'],
            [['date_create', 'date_update'], 'safe'],
            [['author_id'], 'integer'],
            [['name', 'preview', 'date'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Дата добавления',
            'date_update' => 'Дата обновления',
            'preview' => 'Превью',
            'date' => 'Дата выхода',
            'author_id' => 'Автор',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * @return mixed
     */
    public function getPreviewUrl()
    {
        return $this->preview ? Yii::getAlias($this->previewDir) . '/' . $this->preview : null;
    }
    
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->date_create = date('Y-m-d H:i:s');
        }
        $this->date_update = date('Y-m-d H:i:s');

        return parent::beforeSave($insert);
    }
}
