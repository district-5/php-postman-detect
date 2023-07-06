District5 - Postman Detection library
====

Prevent or restrict access to certain API endpoints when using Postman for mock requests.

### Usage...

```
"repositories":[
    {
        "type": "vcs",
        "url": "git@github.com:district-5/php-postman-detect.git"
    }
],

"require": {
    "district5/php-postman-detect": ">=0.0.1"
}
```

### Code usage...

```php
<?php

$_SERVER['HTTP_USER_AGENT'] = 'PostmanRuntime/7.26.8';
\District5\PostmanDetect\PostmanDetector::isPostman(); // true

$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko)';
\District5\PostmanDetect\PostmanDetector::isPostman(); // false


$_SERVER['HTTP_USER_AGENT'] = 'PostmanRuntime/7.26.8';

// Disallow this endpoint with Postman always
\District5\PostmanDetect\PostmanDetector::disallowAlways(); // throws exception

// Current environment is 'local'
// disallow on production
\District5\PostmanDetect\PostmanDetector::disallowOnEnvs('local', ['prod']); // no exception
// disallow on production and staging
\District5\PostmanDetect\PostmanDetector::disallowOnEnvs('local', ['prod', 'staging']); // no exception

// Current environment is 'prod'
// disallow on production
\District5\PostmanDetect\PostmanDetector::disallowOnEnvs('prod', ['prod']); // throws exception
// disallow on production and staging
\District5\PostmanDetect\PostmanDetector::disallowOnEnvs('prod', ['prod', 'staging']); // throws exception

```

### Testing...

```
composer install
./vendor/bin/phpunit
```
