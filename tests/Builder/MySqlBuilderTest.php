<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 6/4/14
 * Time: 12:40 AM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Sql\QueryBuilder\Builder;

use EdituraEDU\Sql\QueryBuilder\Builder\MySqlBuilder;
use EdituraEDU\Sql\QueryBuilder\Manipulation\Select;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class MySqlBuilderTest.
 */
class MySqlBuilderTest extends TestCase
{
    /**
     * @var MySqlBuilder
     */
    protected $writer;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->writer = new MySqlBuilder();
    }

    /**
     *
     */
    protected function tearDown(): void
    {
        $this->writer = null;
    }

#[Test]
    public function itShouldWrapTableNames()
    {
        $query = new Select('user');

        $expected = 'SELECT `user`.* FROM `user`';
        $this->assertSame($expected, $this->writer->write($query));
    }

#[Test]
    public function itShouldWrapColumnNames()
    {
        $query = new Select('user', array('user_id', 'name'));

        $expected = 'SELECT `user`.`user_id`, `user`.`name` FROM `user`';
        $this->assertSame($expected, $this->writer->write($query));
    }

#[Test]
    public function itShouldWrapColumnAlias()
    {
        $query = new Select('user', array('userId' => 'user_id', 'name' => 'name'));

        $expected = 'SELECT `user`.`user_id` AS `userId`, `user`.`name` AS `name` FROM `user`';
        $this->assertSame($expected, $this->writer->write($query));
    }
}
