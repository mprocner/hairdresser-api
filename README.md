# Opis

Zadanie wykonane przy użyciu api-platform i Symfony Flex

# Uruchomienie

## Pobranie repozytorium
* W celu pobrania repozytorium należy uruchomić polecenie `git clone git@github.com:mprocner/hairdresser-api.git`
## Docker
* Do zadania zostało dodane środowisko uruchomieniowe w docker-compose.\
W celu uruchomienia należy z konsoli uruchomić polecenie \
```docker-compose up -d```\
* Aplikacja będzie dostępna przez przeglądarkę pod adresem\
```http://localhost``` \
## Composer
* W celu pobrania zależności należy uruchomić polecenie
```docker-compose exec php composer install```

## Baza danych
### Migracje
* W celu uruchomienia migracji bazy danych należy wykonać polecenie:\
```docker-compose exec php bin/console doctrine:migrations:migrate```
### Fixtures
* W celu dodania przykładowych danych do bazy danych należy wykonać polecenie:\
```docker-compose exec php bin/console doctrine:fixtures:load```
* Domyślnie dodany jest jeden użytkownik: email: `mateusz.procner@gmail.com`, hasło: `12345678`  
### Testowa baza danych
Do testów jest uzywana inna baza danych, która jest czyszczona przed każdym uruchomieniem testu funkcjonalności.

## Generowanie kluczy JWT
Dokumentacja: (https://api-platform.com/docs/core/jwt/#installing-lexikjwtauthenticationbundle)
```
docker-compose exec php sh -c '
    set -e
    apk add openssl
    mkdir -p config/jwt
    jwt_passphrase=$(grep ''^JWT_PASSPHRASE='' .env | cut -f 2 -d ''='')
    echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
    echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
'
```
# Testy
* W folderze `tests` zostały zawarte przykładowe testy.\
* Klasa `FeatureTestCase`, po której dziedziczą testy funkcjonalne czyści bazę danych przed kazdym uruchomieniem testu.\
* Testy uruchamiamy poleceniem ```docker-compose exec php bin/phpunit```\
* Zrobiłem tylko przykładowy test jednostkowy - większa ich ilość sprowadzałaby się do testowania getterów lub setterów, więc nie widziałem w tym sensu
 
# Dokumentacja API
W katalogu docs znajduje się plik `Ready4S.postman_collection.json`, który jest kolekcją requestów Postmana, którą wykorzystywałem pddczas testów
