## def-view
Usage:
```php
use def\View\View;

$view = new View(function (array $data) {
    return print_r($data, true);
});

print $view->fetch(['username' => 'guest']);
```

```php
use def\View\Json;

$json = new Json;

$json->setPrettyPrint();

print $json->fetch(['some' => ['data']]);
```

Assigning variables:

```php
$view->assign('username', 'guest');
print $view->fetch();
```

... with filters:

```php
$view->assign('somevariable', 'somestring', 'ucfirst');

// or

$view->assign('somevariable', 'somestring', 'ucfirst', function ($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
});

// or register filter for reusage:

$view->filter('escape', function ($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
});

$view->assign('somevariable', 'somestring', 'ucfirst', $view->filter('escape'));
```
