<?php
namespace aggregable\yiidbtypecast\components;

use \CMysqlColumnSchema;
use \CDbExpression;

/**
 * Class MySqlColumnSchema
 */
class MySqlColumnSchema extends CMysqlColumnSchema
{
    /**
     * @inheritdoc
     */
    protected function extractType($dbType)
    {
        if (preg_match('/^(int|bit|tinyint|smallint|mediumint)/', $dbType)) {
            $this->type = 'integer';
        } elseif (strpos($dbType, 'decimal') !== false) {
            $this->type = 'double';
        } else {
            parent::extractType($dbType);
        }
    }

    /**
     * @inheritdoc
     */
    public function typecast($value)
    {
        if (gettype($value) === $this->type || $value === null || $value instanceof CDbExpression) {
            return $value;
        }
        if ($value === '' && $this->allowNull) {
            return $this->type === 'string' ? '' : null;
        }
        if ($this->type === 'double') {
            return (float)$value;
        } else {
            return parent::typecast($value);
        }
    }
}