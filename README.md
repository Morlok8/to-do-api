<h2>Установка</h2>
<ol>
    <li> Скопировать URL репозитория; </li>
    <li> Выбрав нужную директорию локального сервера в командной строке, ввести git clone; </li>
    <li> Создать базу в MySQL; </li>
    <li> Отредактировать файл env (или env.example и убрать example), добавив туда название новой базы и заменив sqlite на mysql в строке DB_CONNECTION; </li>
    <li> Выполнить команду composer install; </li>
    <li> Выполнить команду php artisan migrate; </li>
    <li> Выполнить команду php artisan db:seed; </li>
    <li> Выполнить команду php artisan key:generate; </li>
    <li> Запустить сервер, используя команду php artisan serve; </li>    
</ol>

<p>Примичание: поле status принимает исключительно значения "pending", "in work", "completed" and "canceled".</p>
