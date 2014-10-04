## def-view
Simple view helpers package

Basic usage:

```php
use def\View\View;

$view = new View(function(array $data) {
	return print_r($data, true);	
});

print $view->fetch(['username' => 'guest']);
```

*Note: view object takes a callable formatter to constructor - main function,
that will convert youre data to string*

There is also some predefined View classes:

Json:

```php
use def\View\Json;

$json = new Json;

$json->setOption(JSON_PRETTY_PRINT);

print $json->fetch(['some' => ['data']]);
```

or native php templating

```php
use def\View\Template;

$view = new Template;

$view->addPath(__DIR__);
$view->filename('test');
$view->extension('html');

// or just: $view->file(__DIR__ . "/test.html");

print $view->fetch(['username' => 'guest']);
```

Where  _test.html_

```html
Hello, <?=$username?>!
```

You can pass variables into view via fetch method (takes array of variables, like in examples above),

or via assign method

```php
$view->assign('username', 'guest');
print $view->fetch();
```

You can also apply any number of callable filters to value:

```php
$view->assign('username', 'guest', 'ucfirst');

// or

$view->assign('username', 'guest<script>alert("Hello")</script>', 'ucfirst', function($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');		
});

// or register filter for reusage:

$view->filter('escape', function($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');		
});

$view->assign('username', 'guest', 'ucfirst', $view->filter('escape'));
```

*Note: variables passed thru 'assign' method will not be overwriten by variables in 'fetch' array,
so you can pass defaults in 'fetch':*

```php
$view->assign('username', 'andrew', 'ucfirst');
print $view->fetch(['username' => 'guest']);
```

ok, more examples:

```php
use def\View\Composite;
use def\View\View;


$view = new Composite(function(array $data) {
	return "{$data['greating']}\n==={$data['body']}===\n";
});

$view->attach(new View(function($data) {
	return "Hello, {$data['username']}!";	
}), 'greating');

$view->attach(new View(function($data) {
	return "Here is some content, {$data['username']}";	
}), 'body');

print $view->fetch(['username' => 'guest']);
// Hello, guest
// ===Here is some content, guest===
```

```php
use def\View\Strategy;
use def\View\Json;
use def\View\View;

$debug = new Strategy(function(array $data) {
	return print_r($data, true);	
});

$debug->add('json', new Json);

$debug->add('var_export', new View(function(array $data) {
	return var_export($data, true);	
}));

print $debug->fetch(['some' => 'data']); // print_r
print $debug->fetch(['some' => 'data'], 'json'); // json_encode
print $debug->fetch(['some' => 'data'], 'var_export'); // var_export
```

Adapters:

short _twig_ example:

```php
use def\View\Adapter\Twig\String;

print (new String)->template("Hello, {{ username }}!")->fetch(['username' => 'guest']);
```
