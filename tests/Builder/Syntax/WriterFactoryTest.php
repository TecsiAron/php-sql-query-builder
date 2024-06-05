<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 9/12/14
 * Time: 10:47 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Sql\QueryBuilder\Builder\Syntax;

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;
use NilPortugues\Sql\QueryBuilder\Builder\Syntax\PlaceholderWriter;
use NilPortugues\Sql\QueryBuilder\Builder\Syntax\WriterFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class WriterFactoryTest.
 */
class WriterFactoryTest extends TestCase
{
    /**
     * @var PlaceholderWriter
     */
    private $placeholder;

    /**
     * @var GenericBuilder
     */
    private $writer;

    /**
     *
     */
    public function setUp(): void
    {
        $this->writer = new GenericBuilder();
        $this->placeholder = new PlaceholderWriter();
    }

#[Test]
    public function itShouldCreateColumnWriter()
    {
        $writer = WriterFactory::createColumnWriter($this->writer, $this->placeholder);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\ColumnWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreateWhereWriter()
    {
        $writer = WriterFactory::createWhereWriter($this->writer, $this->placeholder);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\WhereWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreateSelectWriter()
    {
        $writer = WriterFactory::createSelectWriter($this->writer, $this->placeholder);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\SelectWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreateInsertWriter()
    {
        $writer = WriterFactory::createInsertWriter($this->writer, $this->placeholder);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\InsertWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreateUpdateWriter()
    {
        $writer = WriterFactory::createUpdateWriter($this->writer, $this->placeholder);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\UpdateWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreateDeleteWriter()
    {
        $writer = WriterFactory::createDeleteWriter($this->writer, $this->placeholder);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\DeleteWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreatePlaceholderWriter()
    {
        $writer = WriterFactory::createPlaceholderWriter();

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\PlaceholderWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreateIntersectWriter()
    {
        $writer = WriterFactory::createIntersectWriter($this->writer);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\IntersectWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreateMinusWriter()
    {
        $writer = WriterFactory::createMinusWriter($this->writer);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\MinusWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreateUnion()
    {
        $writer = WriterFactory::createUnionWriter($this->writer);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\UnionWriter', \get_class($writer));
    }

#[Test]
    public function itShouldCreateUnionAll()
    {
        $writer = WriterFactory::createUnionAllWriter($this->writer);

        $this->assertSame('NilPortugues\Sql\QueryBuilder\Builder\Syntax\UnionAllWriter', \get_class($writer));
    }
}
