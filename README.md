Base de donnée :

php bin/console doctrine:database:create

php bin/console make:entity

php bin/console make:migration

php bin/console doctrine:migrations:migrate

----------------------------------------------

Slug :

composer require cocur/slugify

Create an Entity:

php bin/console make:Entity

------------------------------------------------

Fixtures:

composer require orm-fixtures --dev

php bin/console make:fixtures

php bin/console doctrine:fixtures:load

php bin/console doctrine:fixtures:load --append
