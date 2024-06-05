<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 6/2/14
 * Time: 11:34 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Sql\QueryBuilder\Syntax;

use EdituraEDU\Sql\QueryBuilder\Syntax\Table;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class TableTest.
 */
class TableTest extends TestCase
{
#[Test]
    public function testConstruct()
    {
        $table = new Table('user');
        $this->assertEquals('user', $table->getName());
    }

#[Test]
    public function itShouldReturnNullIfTableNameHasNoAlias()
    {
        $table = new Table('user');
        $this->assertNull($table->getAlias());
    }

#[Test]
    public function itShouldReturnAliasIfTableNameAliasHasBeenSet()
    {
        $table = new Table('user');
        $table->setAlias('u');
        $this->assertEquals('u', $table->getAlias());
    }

#[Test]
    public function itShouldReturnNullIfSchemaNotSet()
    {
        $table = new Table('user');
        $this->assertNull($table->getSchema());
    }

#[Test]
    public function itShouldReturnSchemaIfSchemaHasValue()
    {
        $table = new Table('user', 'website');
        $this->assertEquals('website', $table->getSchema());
    }

#[Test]
    public function itShouldReturnTheCompleteName()
    {
        $table = new Table('user');

        $table->setAlias('p');
        $table->setSchema('website');

        $this->assertEquals('website.user AS p', $table->getCompleteName());
    }

#[Test]
    public function itShouldReturnFalseOnIsView()
    {
        $table = new Table('user_status');
        $this->assertFalse($table->isView());
    }

#[Test]
    public function itShouldReturnTrueOnIsView()
    {
        $table = new Table('user_status');
        $table->setView(true);
        $this->assertTrue($table->isView());
    }
}
