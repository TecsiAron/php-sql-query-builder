<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 6/2/14
 * Time: 11:54 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Sql\QueryBuilder\Syntax;

use EdituraEDU\Sql\QueryBuilder\Syntax\Column;
use EdituraEDU\Sql\QueryBuilder\Syntax\Table;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class ColumnTest.
 */
class ColumnTest extends TestCase
{
    /**
     * @var string
     */
    protected $tableClass = '\EdituraEDU\Sql\QueryBuilder\Syntax\Table';

    /**
     * @var string
     */
    protected $queryException = '\EdituraEDU\Sql\QueryBuilder\Manipulation\QueryException';

#[Test]
    public function itShouldReturnPartName()
    {
        $column = new Column('id', 'user');

        $this->assertSame('COLUMN', $column->partName());
    }

#[Test]
    public function itShouldConstruct()
    {
        $column = new Column('id', 'user');

        $this->assertEquals('id', $column->getName());
        $this->assertInstanceOf($this->tableClass, $column->getTable());
        $this->assertEquals('user', $column->getTable()->getName());
    }

#[Test]
    public function itShouldSetColumnName()
    {
        $column = new Column('id', 'user');

        $column->setName('user_id');
        $this->assertEquals('user_id', $column->getName());
    }

#[Test]
    public function itShouldSetTableName()
    {
        $tableName = 'user';

        $column = new Column('id', $tableName);
        $column->setTable(new Table($tableName));

        $this->assertInstanceOf($this->tableClass, $column->getTable());
        $this->assertEquals($tableName, $column->getTable()->getName());
    }

#[Test]
    public function itShouldSetAliasName()
    {
        $column = new Column('user_id', 'user', 'userId');
        $this->assertEquals('userId', $column->getAlias());
    }

#[Test]
    public function itShouldThrowExceptionIfAliasOnAllSelection()
    {
        $this->expectException($this->queryException);

        new Column('*', 'user', 'userId');
    }
}
