<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name Имя или псевдоним автора
 * @property string $birth_date Год рождения
 * @property int $rating Рейтинг
 *
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    public $book_link;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'birth_date', 'rating'], 'required'],
            [['birth_date'], 'date', 'format' => 'php:Y-m-d'],
            [['birth_date'], 'safe'],
            [['rating'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя или псевдоним автора',
            'birth_date' => 'Год рождения',
            'rating' => 'Рейтинг',
            'book_link' => 'Ссылка на книги автора'
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['author' => 'id'])->orderBy(['year' => SORT_ASC]);
    }
    

}
