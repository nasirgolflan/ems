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
 * @property int $gender
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
            [['salutation', 'first_name', 'last_name', 'email','gender', 'mobile', 'address'], 'required'],
            [['gender', 'department_id'], 'integer'],
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['salutation', 'first_name', 'last_name'], 'string', 'max' => 30],
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
            'id' => 'ID',
            'salutation' => 'Salutation',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'department_id' => 'Department ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
