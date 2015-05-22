#!/bin/bash

/var/www/sando/vendor/bin/phpunit
/var/www/sando/vendor/bin/phpcs --standard=PSR2 /var/www/sando/module --ignore="*/test/*,autoload_classmap.php,*.js"
/var/www/sando/vendor/bin/phpmd /var/www/sando/module text "codesize,naming" --exclude "*/test/*,*/autoload_classmap.php,*.js"
