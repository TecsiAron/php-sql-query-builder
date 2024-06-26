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

use EdituraEDU\Sql\QueryBuilder\Manipulation\Update;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Class UpdateTest.
 */
class UpdateTest extends TestCase
{
    /**
     * @var Update
     */
    private $query;
    /**
     *
     */
    protected function setUp(): void
    {
        $this->query = new Update();
    }

#[Test]
    public function itShouldGetPartName()
    {
        $this->assertSame('UPDATE', $this->query->partName());
    }

#[Test]
    public function itShouldReturnLimit1()
    {
        $this->query->limit(1);

        $this->assertSame(1, $this->query->getLimitStart());
    }

#[Test]
    public function itShouldReturnValues()
    {
        $values = ['user_id' => 1];

        $this->query->setValues($values);

        $this->assertSame($values, $this->query->getValues());
    }

#[Test]
    public function itShouldSetNullableValues()
    {
        $values = ['user_id' => 1, 'description' => null, 'isVisible' => false];

        $this->query->setValues($values);

        $this->assertSame($values, $this->query->getValues());
    }
}
