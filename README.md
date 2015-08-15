# Mars
Sample php program

## Installation
```sh
git clone https://github.com/petun/mars.git
cd mars
composer update
```


## Demo
You can test program from [this page](http://dv.petun.ru/mars/)

## API
Simple usage:
```php
require_once('vendor/autoload.php');

use Rover\RoverApp;

try {
		$app = new RoverApp($_POST['command']);
		$result =  $app->processBatchCommand();

		echo '<pre style="font-weight: bold; font-size: 14px;">';
		echo $result;
		echo '</pre>';

	} catch (Exception $exc) {
		echo '<p style="color: red;">'.$exc->getMessage().'</p>';
	}
```


## Testing
For unit testing just run command from root directory of the project:
```sh
vendor/bin/phpunit test\
```

**Test coverage is 100% now**