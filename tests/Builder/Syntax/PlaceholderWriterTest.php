<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 9/12/14
 * Time: 10:46 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Sql\QueryBuilder\Builder\Syntax;

use EdituraEDU\Sql\QueryBuilder\Builder\Syntax\PlaceholderWriter;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class PlaceholderWriterTest.
 */
class PlaceholderWriterTest extends TestCase
{
    /**
     * @var PlaceholderWriter
     */
    private $writer;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->writer = new PlaceholderWriter();
    }

#[Test]
    public function itShouldAddValueAndReturnPlaceholder()
    {
        $result = $this->writer->add(1);
        $this->assertEquals(':v1', $result);
    }

#[Test]
    public function itShouldAddValueAndGetReturnsArrayHoldingPlaceholderData()
    {
        $this->writer->add(1);
        $this->assertEquals(array(':v1' => 1), $this->writer->get());
    }

#[Test]
    public function itShouldTranslatePhpNullToSqlNullValue()
    {
        $this->writer->add('');
        $this->writer->add(null);

        $this->assertEquals(array(':v1' => 'NULL', ':v2' => 'NULL'), $this->writer->get());
    }

#[Test]
    public function itShouldTranslatePhpBoolToSqlBoolValue()
    {
        $this->writer->add(true);
        $this->writer->add(false);

        $this->assertEquals(array(':v1' => 1, ':v2' => 0), $this->writer->get());
    }
}
