default:
	./bin/phpunit

coverage:
	./bin/phpunit --coverage-html=/tmp/coverage/
