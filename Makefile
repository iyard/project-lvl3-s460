test:
	- composer run-script phpunit tests

install:
	- composer install

run:
	- php -S localhost:8000 -t public

logs:
	- tail -f storage/logs/lumen.log

lint:
	composer run-script phpcs -- --standard=PSR12 --ignore=*/vendor/*,*/tests/*,*/bootstrap/*,*/public/index.php,*/database/*,*.css,*.js ./

lint-fix:
	composer run-script phpcbf -- --standard=PSR12 --ignore=*/vendor/*,*/tests/*,*/bootstrap/*,*/public/index.php,*/database/*,*.css,*.js ./
