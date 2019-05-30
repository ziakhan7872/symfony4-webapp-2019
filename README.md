# symfony4-webapp-2019
PHP Symfony 4 framework used to create a Article listing website, API also integrated.


#Quick start

```
git clone https://github.com/ziakhan7872/symfony4-webapp-2019.git
```

Run composer from project root folder(Make sure you have installed composer on your machine)

```
comopser install
```

Make migration
```
php bin/console make:migration
```

Run migration
```
php bin/console doctrine:migrations:migrate
```

Add some dummy products using fixtures.
```
php bin/console doctrine:fixtures:load --purge-with-truncate
```

