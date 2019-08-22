<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $salutation
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $email
 * @property string $mobile
 * @property string $address
 * @property int $department_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Department $department
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salutation', 'first_name', 'last_name', 'gender', 'email', 'mobile', 'address'], 'required'],
            [['address'], 'string'],
            [['department_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['salutation', 'first_name', 'last_name'], 'string', 'max' => 30],
            [['gender'], 'string', 'max' => 1],
            [['email'], 'string', 'max' => 40],
            [['mobile'], 'string', 'max' => 15],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'salutation' => Yii::t('app', 'Salutation'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'gender' => Yii::t('app', 'Gender'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'address' => Yii::t('app', 'Address'),
            'department_id' => Yii::t('app', 'Department ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
}
