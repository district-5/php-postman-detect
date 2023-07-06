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

/**
 * Class PostmanDetector
 * @package District5\PostmanDetect
 */
class PostmanDetector
{
    /**
     * @return bool
     */
    public static function isPostman(): bool
    {
        // Get the user agent string
        if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            return str_contains($_SERVER['HTTP_USER_AGENT'], 'PostmanRuntime');
        }

        return false;
    }

    /**
     * @return void
     * @throws PostmanNotAllowedException
     */
    public static function disallowAlways(): void
    {
        if (self::isPostman()) {
            throw new PostmanNotAllowedException(
                'Postman is not allowed to access this endpoint'
            );
        }
    }

    /**
     * @param string $currentEnvironment
     * @param array $disallowIn
     * @return void
     * @throws PostmanNotAllowedException
     */
    public static function disallowOnEnvs(string $currentEnvironment, array $disallowIn = ['prod', 'production']): void
    {
        if (!in_array($currentEnvironment, $disallowIn)) {
            return;
        }

        if (self::isPostman()) {
            throw new PostmanNotAllowedException(
                sprintf(
                    'Postman is not allowed to access this endpoint in this environment "%s"',
                    $currentEnvironment
                )
            );
        }
    }
}
