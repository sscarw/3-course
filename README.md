# BarberBook — CRUD веб-застосунок для барбершопу

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10-red?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1%2B-777BB4?logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Docker-Sail-2496ED?logo=docker&logoColor=white" alt="Docker Sail">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

## Опис проєкту

BarberBook — це веб-застосунок для управління послугами та записами барбершопу. Проєкт реалізовано на Laravel з використанням CRUD-операцій для роботи з основними сутностями системи.

Основна ідея проєкту — автоматизувати процес запису клієнта до барбера та надати адміністратору зручну панель для керування барберами й послугами.

## Основний функціонал

### Клієнтська частина

- перегляд доступних барберів;
- перегляд доступних послуг;
- вибір дати запису;
- вибір часового слоту;
- створення запису клієнта;
- перевірка зайнятих часових слотів без перезавантаження сторінки через Fetch API.

### Адміністративна частина

- авторизація адміністратора;
- захист адміністративної панелі через middleware;
- додавання барбера;
- перегляд списку барберів;
- редагування даних барбера;
- видалення барбера;
- додавання послуги;
- перегляд списку послуг;
- редагування назви та ціни послуги;
- видалення послуги.

## CRUD-логіка

У проєкті реалізовано CRUD-операції для таких сутностей:

### Barber

- Create — додавання нового барбера;
- Read — перегляд списку барберів;
- Update — редагування даних барбера;
- Delete — видалення барбера.

### Service

- Create — додавання нової послуги;
- Read — перегляд списку послуг;
- Update — редагування послуги;
- Delete — видалення послуги.

### Appointment

Для записів клієнтів реалізовано:

- Create — створення нового запису;
- Read — перевірка зайнятих часових слотів.

Редагування та видалення записів клієнтів можуть бути додані в майбутніх версіях.

## Технології

- PHP 8.1+
- Laravel 10
- MySQL
- Eloquent ORM
- Blade
- Bootstrap 5
- JavaScript Fetch API
- Laravel Sail
- Docker
- PHPUnit

## Архітектура

Проєкт побудовано як монолітний Laravel-застосунок з використанням архітектурного підходу MVC.

Основні частини:

- `routes/web.php` — маршрути веб-застосунку;
- `app/Http/Controllers` — контролери для обробки запитів;
- `app/Models` — Eloquent-моделі;
- `resources/views` — Blade-шаблони;
- `database/migrations` — структура таблиць бази даних;
- `app/Http/Middleware` — middleware для захисту адміністративної частини.

## Встановлення та запуск

### 1. Клонувати репозиторій

```bash
git clone <repository-url>
cd my-booking-app
