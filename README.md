# This project is only for learning purposes
# Dependencies:
A projekt a symfony keretrendszer legújabb változatát használja
- PHP ^8.1.x
- Symfony ^6.3.x
- Bootstrap ^4.6.2
Adatbázis:
- .env fájl konfig/mysql: root felhasználó jelszó nélkül, dbname=contact
- migrations: >symfony console doctrine:migrations:migrate

Commandok:
- >npm install
- >npm build/npm watch
- local server: symfony server:start -d

# Installation/testing: @TODO