library-management-system tasks

Завдання: Створити CRUD (Create, Read, Update, Delete) веб-додаток для системи керування бібліотекою.

Вимоги:

1. [x] регістрація/авторизація.
2. [x] DB, models, migrations, seeders, factories
3. [x] user Books CRUD controller.
4. [x] Бібліотекар повинен мати можливість шукати книги за назвою, автором чи жанром.
5. [x] Програма повинна відображати повідомлення про помилки, якщо користувач намагається виконати неприпустиму дію (
   наприклад, додати книгу без назви або автора).
6. [x] Додаток повинен бути розроблений з використанням архітектури MVC Laravel та дотримуватися стандартної практики
   кодування (наприклад, правильне використання маршрутизації, моделей, контролерів, уявлень тощо).
7. [x] Додаток повинен використовувати базу даних (наприклад, MySQL) для зберігання інформації про книги.
8. [x] Додаток повинен бути протестований, щоб переконатися у правильності роботи всіх функцій та відсутності помилок.

### DB structure:

#### authors table:

- id

- first_name (string)
- last_name (string)
- bio (text)

- timestamps

#### genres table:

- id

- name (string)

- timestamps

#### books table:

- id

- title (string)
- author_id (foreign key referencing authors.id)
- ISBN (string)
- publish_date (date)

- timestamps

#### book_genre table:

book_id (foreign key books.id)
genre_id (foreign key genres.id)
