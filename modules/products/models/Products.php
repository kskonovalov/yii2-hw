<?php

namespace app\modules\products\models;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property string $created
 * @property string $updated
 * @property string $categories
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['picture'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
            'picture' => 'Picture',
            'created' => 'Created',
            'updated' => 'Updated',
            'categories' => 'Категории',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['id' => 'category_id'])
            ->viaTable('product_category', ['product_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);
        //обновляем категории
        //удаляем старые категории
        ProductCategory::deleteAll(["product_id" => $this->id]);
        //записываем новые
        $product = Yii::$app->request->post("Products");
        if(!empty($product) && $product["categories"]) {
            $categories = $product["categories"];
            foreach($categories as $cat) {
                $productCategory = new ProductCategory();
                $productCategory->product_id = (int)$this->id;
                $productCategory->category_id = (int)$cat;
                $productCategory->save();
            }
        }
    }
}
