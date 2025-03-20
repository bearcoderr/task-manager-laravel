```markdown
# Task Manager

Task Manager — это простое веб-приложение для управления задачами, построенное на фреймворке Laravel. Оно позволяет создавать, редактировать, удалять задачи, отмечать их как выполненные и просматривать детали. Проект использует Blade для рендеринга интерфейса и немного JavaScript для динамического обновления списка задач.

## Основные функции
- Создание новых задач с заголовком, описанием и сроком выполнения.
- Просмотр списка всех задач и выполненных задач отдельно.
- Редактирование существующих задач.
- Удаление задач.
- Отметка задач как выполненных.
- Просмотр детальной информации о задаче.

## Технологии
- **Backend**: Laravel (PHP)
- **Frontend**: Blade, HTML, CSS, JavaScript
- **База данных**: SQLite (по умолчанию, можно настроить MySQL/PostgreSQL)
- **Управление зависимостями**: Composer, npm

## Требования
- PHP >= 8.0
- Composer
- Node.js и npm (для сборки фронтенд-ресурсов)
- Git

## Установка

1. **Клонируйте репозиторий:**
   ```bash
   git clone https://github.com/ваш-username/task-manager.git
   cd task-manager
   ```

2. **Установите зависимости PHP:**
   ```bash
   composer install
   ```

3. **Установите зависимости фронтенда:**
   ```bash
   npm install
   npm run dev
   ```

4. **Настройте файл окружения:**
   - Скопируйте `.env.example` в `.env`:
     ```bash
     cp .env.example .env
     ```
   - Сгенерируйте ключ приложения:
     ```bash
     php artisan key:generate
     ```

5. **Настройте базу данных:**
   - Укажи параметры подключения в `.env` (по умолчанию используется SQLite):
     ```env
     DB_CONNECTION=sqlite
     DB_DATABASE=/absolute/path/to/database.sqlite
     ```
   - Если используешь MySQL или PostgreSQL, обнови соответствующие поля:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=task_manager
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

6. **Выполните миграции:**
   ```bash
   php artisan migrate
   ```

7. **Запустите сервер:**
   ```bash
   php artisan serve
   ```
   Приложение будет доступно по адресу `http://localhost:8000`.

## Использование
- Перейдите на главную страницу (`/`) для просмотра и создания задач.
- Используйте кнопку "Mark Complete" для отметки задачи как выполненной.
- Нажмите "Edit" для редактирования задачи или "Delete" для удаления.
- Перейдите на `/tasks/completed` для просмотра выполненных задач.
- Кликните "Details" для просмотра информации о задаче.

## Структура проекта
- `app/Models/Task.php` — модель задачи.
- `app/Http/Controllers/TaskController.php` — контроллер для управления задачами.
- `resources/views/tasks/` — Blade-шаблоны (`index.blade.php`, `completed.blade.php`, `task-details.blade.php`).
- `public/css/style.css` — стили приложения.
- `public/js/script.js` — клиентская логика для динамического обновления задач.

## Разработка
- Для добавления новых функций создавайте миграции с помощью:
  ```bash
  php artisan make:migration add_field_to_tasks_table
  ```
- Обновляйте `TaskController` и Blade-шаблоны по мере необходимости.
- Для сборки фронтенд-ресурсов используйте:
  ```bash
  npm run watch
  ```

## Вклад в проект
1. Форкните репозиторий.
2. Создайте ветку для новой функции:
   ```bash
   git checkout -b feature/имя-функции
   ```
3. Внесите изменения и закоммитьте:
   ```bash
   git commit -m "Добавлена новая функция"
   ```
4. Отправьте изменения в свой форк:
   ```bash
   git push origin feature/имя-функции
   ```
5. Создайте Pull Request в основной репозиторий.

## Лицензия
Проект распространяется под лицензией MIT. См. файл `LICENSE` для подробностей.

## Контакты
Если у вас есть вопросы, пишите на [bearcoderr@gmail.com](mailto:bearcoderr@gmail.com) или создавайте issue в репозитории.
```