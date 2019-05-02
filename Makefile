default:
	./bin/phpunit

agile:
	./bin/phpunit --testdox

coverage:
	./bin/phpunit --coverage-html=/tmp/coverage/
