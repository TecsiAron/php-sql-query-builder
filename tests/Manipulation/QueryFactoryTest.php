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

use NilPortugues\Sql\QueryBuilder\Manipulation\QueryFactory;
use NilPortugues\Sql\QueryBuilder\Manipulation\Select;
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
        $className = '\NilPortugues\Sql\QueryBuilder\Manipulation\Select';
        $this->assertInstanceOf($className, QueryFactory::createSelect());
    }

#[Test]
    public function itShouldCreateInsertObject()
    {
        $className = '\NilPortugues\Sql\QueryBuilder\Manipulation\Insert';
        $this->assertInstanceOf($className, QueryFactory::createInsert());
    }

#[Test]
    public function itShouldCreateUpdateObject()
    {
        $className = '\NilPortugues\Sql\QueryBuilder\Manipulation\Update';
        $this->assertInstanceOf($className, QueryFactory::createUpdate());
    }

#[Test]
    public function itShouldCreateDeleteObject()
    {
        $className = '\NilPortugues\Sql\QueryBuilder\Manipulation\Delete';
        $this->assertInstanceOf($className, QueryFactory::createDelete());
    }

#[Test]
    public function itShouldCreateMinusObject()
    {
        $className = '\NilPortugues\Sql\QueryBuilder\Manipulation\Minus';
        $this->assertInstanceOf($className, QueryFactory::createMinus(new Select('table1'), new Select('table2')));
    }

#[Test]
    public function itShouldCreateUnionObject()
    {
        $className = '\NilPortugues\Sql\QueryBuilder\Manipulation\Union';
        $this->assertInstanceOf($className, QueryFactory::createUnion());
    }

#[Test]
    public function itShouldCreateUnionAllObject()
    {
        $className = '\NilPortugues\Sql\QueryBuilder\Manipulation\UnionAll';
        $this->assertInstanceOf($className, QueryFactory::createUnionAll());
    }

#[Test]
    public function itShouldCreateWhereObject()
    {
        $mockClass = '\NilPortugues\Sql\QueryBuilder\Manipulation\QueryInterface';

        $query = $this->getMockBuilder($mockClass)
            ->disableOriginalConstructor()
            ->getMock();

        $className = '\NilPortugues\Sql\QueryBuilder\Syntax\Where';
        $this->assertInstanceOf($className, QueryFactory::createWhere($query));
    }
}
