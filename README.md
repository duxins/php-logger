#php-logger

##Example

```php
$logger = new Logger('DEBUG');
$logger->debug("Sending email to");
$logger->error("Message File not found");
$logger->error("failed", Logger::COLOR_RED);
```

##Log Levels

* ERROR = 1
* WARNING = 2
* INFO =3
* DEBUG 4

