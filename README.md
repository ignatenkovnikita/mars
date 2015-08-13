# Mars
Sample php program

## Installation
### From github
```sh
git clone https://github.com/petun/mars.git
cd mars
composer update
```

### From composer
Add to your composer.json:
```javascript
...
"require": {
    ...
    "petun/mars":"dev/master"
}
..
```


## API
Simple usage:
```php
require_once('vendor/autoload.php');

use Rover\Input;
use Rover\RoverApp;

$app = new RoverApp();
$app->processBatchCommand($str);
$app->batchResult();
```


## Testing
For unit testing just run command from root directory of the project:
```sh
vendor/bin/phpunit test\
```