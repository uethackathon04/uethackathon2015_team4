<?php

/**
 * This is the model base class for the table "post".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Post".
 *
 * Columns in table "post" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $location_id
 * @property string $content
 * @property integer $date
 * @property integer $post_like_count
 * @property integer $post_comment_count
 * @property string $image
 *
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
			array('user_id, content, date', 'required'),
			array('user_id, location_id, date, post_like_count, post_comment_count', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>255),
			array('location_id, post_like_count, post_comment_count, image', 'default', 'setOnEmpty' => true, 'value' => null),
			array('post_id, user_id, location_id, content, date, post_like_count, post_comment_count, image', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'post_id' => Yii::t('app', 'Post'),
			'user_id' => Yii::t('app', 'User'),
			'location_id' => Yii::t('app', 'Location'),
			'content' => Yii::t('app', 'Content'),
			'date' => Yii::t('app', 'Date'),
			'post_like_count' => Yii::t('app', 'Post Like Count'),
			'post_comment_count' => Yii::t('app', 'Post Comment Count'),
			'image' => Yii::t('app', 'Image'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('post_id', $this->post_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('location_id', $this->location_id);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('date', $this->date);
		$criteria->compare('post_like_count', $this->post_like_count);
		$criteria->compare('post_comment_count', $this->post_comment_count);
		$criteria->compare('image', $this->image, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}