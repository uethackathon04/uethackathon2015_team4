<?php

/**
 * This is the model base class for the table "post".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Post".
 *
 * Columns in table "post" available as properties of the model,
 * followed by relations of table "post" available as properties of the model.
 *
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $location_id
 * @property string $content
 * @property integer $date
 *
 * @property Comment[] $comments
 * @property User $user
 * @property Location $location
 * @property User[] $users
 * @property Subject[] $subjects
 */
abstract class BasePost extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'post';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Post|Posts', $n);
	}

	public static function representingColumn() {
		return 'content';
	}

	public function rules() {
		return array(
			array('post_id, user_id, location_id, content, date', 'required'),
			array('post_id, user_id, location_id, date', 'numerical', 'integerOnly'=>true),
			array('post_id, user_id, location_id, content, date', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'post_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'location' => array(self::BELONGS_TO, 'Location', 'location_id'),
			'users' => array(self::MANY_MANY, 'User', 'post_like(post_id, user_id)'),
			'subjects' => array(self::MANY_MANY, 'Subject', 'post_subject(post_id, subject_id)'),
		);
	}

	public function pivotModels() {
		return array(
			'users' => 'PostLike',
			'subjects' => 'PostSubject',
		);
	}

	public function attributeLabels() {
		return array(
			'post_id' => Yii::t('app', 'Post'),
			'user_id' => null,
			'location_id' => null,
			'content' => Yii::t('app', 'Content'),
			'date' => Yii::t('app', 'Date'),
			'comments' => null,
			'user' => null,
			'location' => null,
			'users' => null,
			'subjects' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('post_id', $this->post_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('location_id', $this->location_id);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('date', $this->date);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}