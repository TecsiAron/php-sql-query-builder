<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 6/3/14
 * Time: 12:31 AM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Sql\QueryBuilder\Syntax;

use NilPortugues\Sql\QueryBuilder\Manipulation\Select;
use NilPortugues\Sql\QueryBuilder\Syntax\Where;
use NilPortugues\Tests\Sql\QueryBuilder\Manipulation\Resources\DummyQuery;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class WhereTest.
 */
class WhereTest extends TestCase
{
    /**
     * @var Where
     */
    protected $where;

    /**
     * @var string
     */
    protected $whereClass = '\NilPortugues\Sql\QueryBuilder\Syntax\Where';

    /**
     * @var string
     */
    protected $columnClass = '\NilPortugues\Sql\QueryBuilder\Syntax\Column';

    /**
     * @var string
     */
    protected $queryException = '\NilPortugues\Sql\QueryBuilder\Manipulation\QueryException';

    /**
     *
     */
    protected function setUp(): void
    {
        $query = new DummyQuery();
        $query->setTable('users');

        $this->where = new Where($query);
    }

#[Test]
    public function itShouldBeCloneable()
    {
        $this->assertEquals($this->where, clone $this->where);
    }

#[Test]
    public function itShouldBeEmptyOnConstruct()
    {
        $this->assertTrue($this->where->isEmpty());
    }

#[Test]
    public function itShouldReturnDefaultConjuctionAnd()
    {
        $this->assertSame('AND', $this->where->getConjunction());
    }

#[Test]
    public function itShouldReturnDefaultSubWhere()
    {
        $this->assertSame(array(), $this->where->getSubWheres());
    }

#[Test]
    public function itShouldReturnSubFilter()
    {
        $filter = $this->where->subWhere();

        $this->assertSame(array(), $filter->getSubWheres());
        $this->assertInstanceOf($this->whereClass, $filter);
    }

#[Test]
    public function itShouldReturnTheSameEqAndEqual()
    {
        $column = 'user_id';
        $value = 1;

        $this->assertSame(
            $this->where->equals($column, $value),
            $this->where->eq($column, $value)
        );
    }

#[Test]
    public function itShouldNotBeEqualTo()
    {
        $column = 'user_id';
        $value = 1;

        $result = $this->where->notEquals($column, $value)->getComparisons();

        $this->assertSame('<>', $result[0]['conjunction']);
        $this->assertSame($column, $result[0]['subject']->getName());
        $this->assertSame($value, $result[0]['target']);
    }

#[Test]
    public function itShouldBeGreaterThan()
    {
        $column = 'user_id';
        $value = 1;

        $result = $this->where->greaterThan($column, $value)->getComparisons();

        $this->assertSame('>', $result[0]['conjunction']);
        $this->assertSame($column, $result[0]['subject']->getName());
        $this->assertSame($value, $result[0]['target']);
    }

#[Test]
    public function itShouldBeGreaterThanOrEqual()
    {
        $column = 'user_id';
        $value = 1;

        $result = $this->where->greaterThanOrEqual($column, $value)->getComparisons();

        $this->assertSame('>=', $result[0]['conjunction']);
        $this->assertSame($column, $result[0]['subject']->getName());
        $this->assertSame($value, $result[0]['target']);
    }

#[Test]
    public function itShouldBeLessThan()
    {
        $column = 'user_id';
        $value = 1;

        $result = $this->where->lessThan($column, $value)->getComparisons();

        $this->assertSame('<', $result[0]['conjunction']);
        $this->assertSame($column, $result[0]['subject']->getName());
        $this->assertSame($value, $result[0]['target']);
    }

#[Test]
    public function itShouldBeLessThanOrEqual()
    {
        $column = 'user_id';
        $value = 1;

        $result = $this->where->lessThanOrEqual($column, $value)->getComparisons();

        $this->assertSame('<=', $result[0]['conjunction']);
        $this->assertSame($column, $result[0]['subject']->getName());
        $this->assertSame($value, $result[0]['target']);
    }

#[Test]
    public function itShouldBeLike()
    {
        $column = 'user_id';
        $value = 1;

        $result = $this->where->like($column, $value)->getComparisons();

        $this->assertSame('LIKE', $result[0]['conjunction']);
        $this->assertSame($column, $result[0]['subject']->getName());
        $this->assertSame($value, $result[0]['target']);
    }

#[Test]
    public function itShouldBeNotLike()
    {
        $column = 'user_id';
        $value = 1;

        $result = $this->where->notLike($column, $value)->getComparisons();

        $this->assertSame('NOT LIKE', $result[0]['conjunction']);
        $this->assertSame($column, $result[0]['subject']->getName());
        $this->assertSame($value, $result[0]['target']);
    }

#[Test]
    public function itShouldAccumulateMatchConditions()
    {
        $column = array('user_id');

        $result = $this->where
            ->match($column, array(1, 2, 3))
            ->getMatches();

        $expected = array(
            0 => array(
                'columns' => array('user_id'),
                'values' => array(1, 2, 3),
                'mode' => 'natural',
            ),
        );
        $this->assertEquals($expected, $result);
    }

#[Test]
    public function itShouldAccumulateMatchBooleanConditions()
    {
        $column = array('user_id');

        $result = $this->where
            ->matchBoolean($column, array(1, 2, 3))
            ->getMatches();

        $expected = array(
            0 => array(
                'columns' => array('user_id'),
                'values' => array(1, 2, 3),
                'mode' => 'boolean',
            ),
        );
        $this->assertEquals($expected, $result);
    }

#[Test]
    public function itShouldAccumulateMatchQueryExpansionConditions()
    {
        $column = array('user_id');

        $result = $this->where
            ->matchWithQueryExpansion($column, array(1, 2, 3))
            ->getMatches();

        $expected = array(
            0 => array(
                'columns' => array('user_id'),
                'values' => array(1, 2, 3),
                'mode' => 'query_expansion',
            ),
        );
        $this->assertEquals($expected, $result);
    }

#[Test]
    public function itShouldAccumulateInConditions()
    {
        $column = 'user_id';

        $result = $this->where
            ->in($column, array(1, 2, 3))
            ->getIns();

        $expected = array($column => array(1, 2, 3));
        $this->assertEquals($expected, $result);
    }

#[Test]
    public function itShouldAccumulateNotInConditions()
    {
        $column = 'user_id';

        $result = $this->where
            ->notIn($column, array(1, 2, 3))
            ->getNotIns();

        $expected = array($column => array(1, 2, 3));
        $this->assertEquals($expected, $result);
    }

#[Test]
    public function itShouldWriteBetweenConditions()
    {
        $column = 'user_id';

        $result = $this->where
            ->between($column, 1, 2)
            ->getBetweens();

        $this->assertInstanceOf($this->columnClass, $result[0]['subject']);
        $this->assertEquals(1, $result[0]['a']);
        $this->assertEquals(2, $result[0]['b']);
    }

#[Test]
    public function itShouldSetNullValueCondition()
    {
        $column = 'user_id';

        $result = $this->where
            ->isNull($column)
            ->getNull();

        $this->assertInstanceOf($this->columnClass, $result[0]['subject']);
    }

#[Test]
    public function itShouldSetIsNotNullValueCondition()
    {
        $column = 'user_id';

        $result = $this->where
            ->isNotNull($column)
            ->getNotNull();

        $this->assertInstanceOf($this->columnClass, $result[0]['subject']);
    }

#[Test]
    public function itShouldSetBitClauseValueCondition()
    {
        $column = 'user_id';

        $result = $this->where
            ->addBitClause($column, 1)
            ->getBooleans();

        $this->assertEquals(1, $result[0]['value']);
        $this->assertInstanceOf($this->columnClass, $result[0]['subject']);
    }

#[Test]
    public function ItShouldChangeAndToOrOperator()
    {
        $result = $this->where->conjunction('OR');
        $this->assertEquals('OR', $result->getConjunction());
    }

#[Test]
    public function itShouldThrowExceptionOnUnknownConjunction()
    {
        $this->expectException($this->queryException);
        $this->where->conjunction('NOT_VALID_CONJUNCTION');
    }

#[Test]
    public function itShouldSetExistsCondition()
    {
        $select1 = new Select('user');
        $select1->where()->equals('user_id', 10);

        $result = $this->where->exists($select1)->getExists();

        $this->assertEquals(array($select1), $result);
    }

#[Test]
    public function itShouldSetNotExistsCondition()
    {
        $select1 = new Select('user');
        $select1->where()->equals('user_id', 10);

        $result = $this->where->notExists($select1)->getNotExists();

        $this->assertEquals(array($select1), $result);
    }

#[Test]
    public function itShouldReturnLiterals()
    {
        $result = $this->where->asLiteral('(username is not null and status=:status)')->getComparisons();
        $this->assertSame('(username is not null and status=:status)', $result[0]);
    }
}
