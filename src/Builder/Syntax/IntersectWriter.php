<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 9/12/14
 * Time: 7:15 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EdituraEDU\Sql\QueryBuilder\Builder\Syntax;

use EdituraEDU\Sql\QueryBuilder\Manipulation\Intersect;

/**
 * Class IntersectWriter.
 */
class IntersectWriter extends AbstractSetWriter
{
    /**
     * @param Intersect $intersect
     *
     * @return string
     */
    public function write(Intersect $intersect)
    {
        return $this->abstractWrite($intersect, 'getIntersects', Intersect::INTERSECT);
    }
}
