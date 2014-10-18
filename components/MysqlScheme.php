<?php
namespace aggregable\yiidbtypecast\components;

use \CMysqlSchema;

/**
 * Class MysqlScheme
 */
class MysqlScheme extends CMySqlSchema
{
    /**
     * @inheritdoc
     */
    protected function createColumn($column)
    {
        $c = $this->createColumnScheme();
        $c->name = $column['Field'];
        $c->rawName = $this->quoteColumnName($c->name);
        $c->allowNull = $column['Null'] === 'YES';
        $c->isPrimaryKey = strpos($column['Key'], 'PRI') !== false;
        $c->isForeignKey = false;
        $c->init($column['Type'], $column['Default']);
        $c->autoIncrement = strpos(strtolower($column['Extra']), 'auto_increment') !== false;
        if (isset($column['Comment'])) {
            $c->comment = $column['Comment'];
        }

        return $c;
    }

    /**
     * @return MysqlColumnSchema
     */
    protected function createColumnScheme()
    {
        return new MysqlColumnSchema();
    }
}