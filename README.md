Описание
=========================
Точка входа для проверки парсера сам файлик parser.php, аргументом принимает путь к файлу логов

Утилиты стандартных методов php вынесены в Library\Utils, все что касается парсера в дирректории Library\Parsers

Архитектура с учетом того, что может быть несколько парсеров, разных логов, где могут потребоваться разные
обработчики спарсенных данных и представления. В дирректориях дополнительно лежат README.md для ознакомления, что и где должно быть.


Пример
-----------------

*command:*
```bash
php parser.php ./access.log
```
*answer:*
```bash
{"views":4,"urls":5,"traffic":212816,"crawlers":{"Google":2,"Bing":0,"Baidu":0,"Yandex":0},"statusCodes":{"200":14,"301":2}}
```