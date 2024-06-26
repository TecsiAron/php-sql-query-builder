<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 9/12/14
 * Time: 10:45 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Sql\QueryBuilder\Builder\Syntax;

use EdituraEDU\Sql\QueryBuilder\Builder\GenericBuilder;
use EdituraEDU\Sql\QueryBuilder\Manipulation\Insert;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class InsertWriterTest.
 */
class InsertWriterTest extends TestCase
{
    /**
     * @var GenericBuilder
     */
    private $writer;

    /**
     * @var Insert
     */
    private $query;

    /**
     * @var string
     */
    private $exceptionClass = '\EdituraEDU\Sql\QueryBuilder\Manipulation\QueryException';

    /**
     *
     */
    protected function setUp(): void
    {
        $this->writer = new GenericBuilder();
        $this->query = new Insert();
    }

#[Test]
    public function itShouldThrowQueryExceptionBecauseNoColumnsWereDefined()
    {
        $this->expectException($this->exceptionClass);
        $this->query->setTable('user');
        $this->writer->write($this->query);
    }

#[Test]
    public function itShouldWriteInsertQuery()
    {
        $valueArray = array(
            'user_id' => 1,
            'name' => 'Nil',
            'contact' => 'contact@nilportugues.com',
        );

        $this->query
            ->setTable('user')
            ->setValues($valueArray);

        $expected = 'INSERT INTO user (user.user_id, user.name, user.contact) VALUES (:v1, :v2, :v3)';

        $this->assertSame($expected, $this->writer->write($this->query));
        $this->assertEquals(\array_values($valueArray), \array_values($this->query->getValues()));

        $expected = array(':v1' => 1, ':v2' => 'Nil', ':v3' => 'contact@nilportugues.com');
        $this->assertEquals($expected, $this->writer->getValues());
    }

#[Test]
    public function itShouldBeAbleToWriteCommentInQuery()
    {
        $valueArray = array(
            'user_id' => 1,
            'name' => 'Nil',
            'contact' => 'contact@nilportugues.com',
        );

        $this->query
            ->setTable('user')
            ->setComment('This is a comment')
            ->setValues($valueArray);

        $expected = "-- This is a comment\n".'INSERT INTO user (user.user_id, user.name, user.contact) VALUES (:v1, :v2, :v3)';

        $this->assertSame($expected, $this->writer->write($this->query));
        $this->assertEquals(\array_values($valueArray), \array_values($this->query->getValues()));

        $expected = array(':v1' => 1, ':v2' => 'Nil', ':v3' => 'contact@nilportugues.com');
        $this->assertEquals($expected, $this->writer->getValues());
    }
}
