yii-db-typecast
===============

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist aggregable/yii-db-typecast "@dev"
```

or add

```
"aggregable/yii-db-typecast": "@dev"
```

to the require section of your composer.json.

Component configuration
------------

	'components' => [
		'db' => [
			'driverMap' => ['mysql' => '\aggregable\yiidbtypecast\components\MySqlSchema'],
		],
		...
	],

ActiveRecord models configuration
------------
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return array_merge(parent::behaviors(), [
			'typecast' => [
				'class' => '\aggregable\yiidbtypecast\components\ActiveRecordTypecastBehavior',
			]
		]);
	}
