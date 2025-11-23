# MiniCRM

Клонировать репозиторий:

```bash
git clone https://github.com/singlephon/miniCRM.git
cd miniCRM
```

Скопировать .env файл:

```bash
cp .env.example .env
```

Установить зависимости:

```bash
composer install
npm install && npm run build
```

Собрать и поднять контейнеры:

```bash
./vendor/bin/sail build --no-cache
./vendor/bin/sail up -d
```

Выполнить команду подготовки миграции и заполнения бд:

```bash
./vendor/bin/sail artisan app:prepare
```

Открыть в браузере:

```bash
http://localhost
```

### 🔐 Доступ в dashboard (для админа и менеджера)

```bash
http://localhost/login
```
Email: admin@minicrm.com или manager@minicrm.com <br />
Пароль: password

API примеры находятся в папке postman
