<?php

namespace app\modules\products\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $title
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public static function getAllCategories()
    {
        $allCategories = Categories::find()->all();
        $allCategories = ArrayHelper::toArray($allCategories, [
            'app\modules\products\models\Categories' => [
                'id',
                'title',
            ],
        ]);
        $allCategories = ArrayHelper::map($allCategories, "id", "title");
        return $allCategories;
    }
}
