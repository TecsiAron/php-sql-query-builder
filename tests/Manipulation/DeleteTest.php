<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 6/3/14
 * Time: 1:37 AM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Sql\QueryBuilder\Manipulation;

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;
use NilPortugues\Sql\QueryBuilder\Manipulation\Delete;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class DeleteTest.
 */
class DeleteTest extends TestCase
{
    /**
     * @var GenericBuilder
     */
    private $writer;

    /**
     * @var Delete
     */
    private $query;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->query = new Delete();
    }

#[Test]
    public function itShouldGetPartName()
    {
        $this->assertSame('DELETE', $this->query->partName());
    }

#[Test]
    public function itShouldReturnLimit1()
    {
        $this->query->limit(1);

        $this->assertSame(1, $this->query->getLimitStart());
    }
}
