<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 9/12/14
 * Time: 7:11 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EdituraEDU\Sql\QueryBuilder\Manipulation;

use EdituraEDU\Sql\QueryBuilder\Syntax\QueryPartInterface;

/**
 * Class Minus.
 */
class Minus implements QueryInterface, QueryPartInterface
{
    const MINUS = 'MINUS';

    /**
     * @var Select
     */
    protected $first;

    /**
     * @var Select
     */
    protected $second;

    /**
     * @return string
     */
    public function partName()
    {
        return 'MINUS';
    }

    /***
     * @param Select $first
     * @param Select $second
     */
    public function __construct(Select $first, Select $second)
    {
        $this->first = $first;
        $this->second = $second;
    }

    /**
     * @return \EdituraEDU\Sql\QueryBuilder\Manipulation\Select
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @return \EdituraEDU\Sql\QueryBuilder\Manipulation\Select
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * @throws QueryException
     *
     * @return \EdituraEDU\Sql\QueryBuilder\Syntax\Table
     */
    public function getTable()
    {
        throw new QueryException('MINUS does not support tables');
    }

    /**
     * @throws QueryException
     *
     * @return \EdituraEDU\Sql\QueryBuilder\Syntax\Where
     */
    public function getWhere()
    {
        throw new QueryException('MINUS does not support WHERE.');
    }

    /**
     * @throws QueryException
     *
     * @return \EdituraEDU\Sql\QueryBuilder\Syntax\Where
     */
    public function where()
    {
        throw new QueryException('MINUS does not support the WHERE statement.');
    }
}
