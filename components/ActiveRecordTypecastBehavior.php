<?php
namespace aggregable\yiidbtypecast\components;

use \CActiveRecordBehavior,
	\CDbColumnSchema,
	\CActiveRecord;

/**
 * Class ActiveRecordTypecastBehavior
 *
 * @method \CActiveRecord getOwner()
 */
class ActiveRecordTypecastBehavior extends CActiveRecordBehavior {
	/**
	 * @inheritdoc
	 */
	public function afterFind($event) {
		$md = $this->getOwner()->getMetaData();
		foreach ($this->getOwner()->getAttributes() as $name => $attribute) {
			if (isset($md->columns[$name])) {
				/** @var CDbColumnSchema $c */
				$c = $md->columns[$name];
				$this->getOwner()->setAttribute($name, $c->typecast($attribute));
			}
		}
	}
}