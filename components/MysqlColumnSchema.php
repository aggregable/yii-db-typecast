<?php
namespace aggregable\yiidbtypecast\components;

use \CMysqlColumnSchema;

/**
 * Class MysqlColumnSchema
 */
class MysqlColumnSchema extends CMysqlColumnSchema
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
        if ($this->type === 'double') {
            return (float)$value;
        } else {
            return parent::typecast($value);
        }
    }
}