<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property int $author
 * @property int $year
 * @property string $title
 * @property int $rating
 *
 * @property Authors $author0
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'year', 'title', 'rating'], 'required'],
            [['author', 'year', 'rating'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Автор',
            'year' => 'Год издания',
            'title' => 'Названия',
            'rating' => 'Рейтинг',
        ];
    }

    /**
     * Gets query for [[Author0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author']);
    }
}
