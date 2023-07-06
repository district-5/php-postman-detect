<?php
/**
 * District5 - Postman detector
 *
 * @copyright District5
 *
 * @author District5
 * @link https://www.district5.co.uk
 *
 * @license This software and associated documentation (the "Software") may not be
 * used, copied, modified, distributed, published or licensed to any 3rd party
 * without the written permission of District5 or its author.
 *
 * The above copyright notice and this permission notice shall be included in
 * all licensed copies of the Software.
 *
 */

namespace District5\PostmanDetect;

use Exception;

/**
 * Class PostmanDetector
 * @package District5\PostmanDetect
 */
class PostmanNotAllowedException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Postman is not allowed to access';
}
