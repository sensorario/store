default:
	./bin/phpunit

agile-doc:
	./bin/phpunit --testdox --color

coverage:
	./bin/phpunit --coverage-html=/tmp/coverage/
