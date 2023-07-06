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

namespace District5Tests\PostmanDetectTests;


use District5\PostmanDetect\PostmanDetector;
use District5\PostmanDetect\PostmanNotAllowedException;

/**
 * Class PostmanDetectorTest
 * @package District5Tests\PostmanDetectTests
 */
class PostmanDetectorTest extends TestAbstract
{
    /**
     * @return void
     */
    public function testBasic()
    {
        $this->assertFalse(
            PostmanDetector::isPostman()
        );

        $_SERVER['HTTP_USER_AGENT'] = 'PostmanRuntime/7.26.8';

        $this->assertTrue(
            PostmanDetector::isPostman()
        );
    }

    /**
     * @return void
     * @throws PostmanNotAllowedException
     */
    public function testDisallowAlways()
    {
        $this->expectException(PostmanNotAllowedException::class);
        $this->expectExceptionMessage('Postman is not allowed to access');

        $_SERVER['HTTP_USER_AGENT'] = 'PostmanRuntime/7.26.8';
        PostmanDetector::disallowAlways();
    }

    /**
     * @return void
     * @throws PostmanNotAllowedException
     */
    public function testDisallowAlwaysWhenNotPostman()
    {
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36';
        PostmanDetector::disallowAlways();

        // If we get here, we're good
        $this->assertTrue(true);
    }

    /**
     * @return void
     * @throws PostmanNotAllowedException
     */
    public function testDisallowOnEnvs()
    {
        $this->expectException(PostmanNotAllowedException::class);

        $_SERVER['HTTP_USER_AGENT'] = 'PostmanRuntime/7.26.8';
        PostmanDetector::disallowOnEnvs('prod', ['prod', 'staging']);
    }

    /**
     * @return void
     * @throws PostmanNotAllowedException
     */
    public function testDisallowOnEnvsNotProd()
    {
        $_SERVER['HTTP_USER_AGENT'] = 'PostmanRuntime/7.26.8';
        PostmanDetector::disallowOnEnvs('dev', ['production']);

        // If we get here, we're good
        $this->assertTrue(true);
    }
}
