<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 6/16/14
 * Time: 8:50 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Sql\QueryBuilder\Manipulation;

use EdituraEDU\Sql\QueryBuilder\Manipulation\QueryFactory;
use EdituraEDU\Sql\QueryBuilder\Manipulation\Select;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class QueryFactoryTest.
 */
class QueryFactoryTest extends TestCase
{
#[Test]
    public function itShouldCreateSelectObject()
    {
        $className = '\EdituraEDU\Sql\QueryBuilder\Manipulation\Select';
        $this->assertInstanceOf($className, QueryFactory::createSelect());
    }

#[Test]
    public function itShouldCreateInsertObject()
    {
        $className = '\EdituraEDU\Sql\QueryBuilder\Manipulation\Insert';
        $this->assertInstanceOf($className, QueryFactory::createInsert());
    }

#[Test]
    public function itShouldCreateUpdateObject()
    {
        $className = '\EdituraEDU\Sql\QueryBuilder\Manipulation\Update';
        $this->assertInstanceOf($className, QueryFactory::createUpdate());
    }

#[Test]
    public function itShouldCreateDeleteObject()
    {
        $className = '\EdituraEDU\Sql\QueryBuilder\Manipulation\Delete';
        $this->assertInstanceOf($className, QueryFactory::createDelete());
    }

#[Test]
    public function itShouldCreateMinusObject()
    {
        $className = '\EdituraEDU\Sql\QueryBuilder\Manipulation\Minus';
        $this->assertInstanceOf($className, QueryFactory::createMinus(new Select('table1'), new Select('table2')));
    }

#[Test]
    public function itShouldCreateUnionObject()
    {
        $className = '\EdituraEDU\Sql\QueryBuilder\Manipulation\Union';
        $this->assertInstanceOf($className, QueryFactory::createUnion());
    }

#[Test]
    public function itShouldCreateUnionAllObject()
    {
        $className = '\EdituraEDU\Sql\QueryBuilder\Manipulation\UnionAll';
        $this->assertInstanceOf($className, QueryFactory::createUnionAll());
    }

#[Test]
    public function itShouldCreateWhereObject()
    {
        $mockClass = '\EdituraEDU\Sql\QueryBuilder\Manipulation\QueryInterface';

        $query = $this->getMockBuilder($mockClass)
            ->disableOriginalConstructor()
            ->getMock();

        $className = '\EdituraEDU\Sql\QueryBuilder\Syntax\Where';
        $this->assertInstanceOf($className, QueryFactory::createWhere($query));
    }
}
