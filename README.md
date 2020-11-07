# Gravatar with PHP

Component to search and obtain images registered in the Gravatar service.

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/dc291bd6d6d6459e978653166a4c7061)](https://www.codacy.com/app/Diego-Brocanelli/image-gravatar-php?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Diego-Brocanelli/image-gravatar-php&amp;utm_campaign=Badge_Grade)
[![Code Climate](https://codeclimate.com/github/Diego-Brocanelli/image-gravatar-php/badges/gpa.svg)](https://codeclimate.com/github/Diego-Brocanelli/image-gravatar-php)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/6424e00b-3154-4716-bc25-03eec84e87dd/small.png)](https://insight.sensiolabs.com/projects/6424e00b-3154-4716-bc25-03eec84e87dd)


## Requirements

- PHP >= 7.4;
- Composer.

## Tests

To run the component tests, run the command below.


```bash
composer tests
```

## Code Analysis

The command below will run PHPStan level 4 analysis.

```bash
composer code-analysis
```

# How to use 

## Instalation

```php

composer require diego-brocanelli/image-gravatar-php dev-master

```

### Getting image URL

```php

<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Gravatar;

$email = 'hackershousebr@gmail.com';
$gravatar = new Gravatar($email);

$url = $gravatar->buildURL(); // return: https://www.gravatar.com/avatar/dfeea822891ef9e6df82ec9f4a74cf8d?s=80&d=mm&r=g

```

### Getting an image tag

```php

<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Gravatar;

$email = 'hackershousebr@gmail.com';
$gravatar = new Gravatar($email);

$image = $gravatar->buildImage(); // return: <img src='https://www.gravatar.com/avatar/dfeea822891ef9e6df82ec9f4a74cf8d?s=80&d=mm&r=g'/>

```

# Configurations

### Image Size

It can be used between 1px - 2048px, by default used 80px;

#### Example:

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Gravatar;

$email = 'hackershousebr@gmail.com';
$gravatar = new Gravatar($email);

$gravatar->setImageSize(200); // return image 200px
```

### Image Set

The following options are available [404 | mm | identicon | monsterid | wavatar] 'mm' is used by default.

#### Example:

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Gravatar;

$email = 'hackershousebr@gmail.com';
$gravatar = new Gravatar($email);

$gravatar->setImageSet('wavatar');
```

### Maximum rating

We have the following options available [g | pg | r | x] 'g' is used by default.

#### Exemple:
```php

<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Gravatar;

$email = 'hackershousebr@gmail.com';
$gravatar = new Gravatar($email);

$gravatar->setMaxRating('pg');
```

### Image Options

We can include attributes in our image, thus facilitating its use, in the example below the CSS class 'image-gravatar' is inserted

#### Exemple:

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Gravatar;

$email = 'hackershousebr@gmail.com';
$gravatar = new Gravatar($email);

$gravatar->setImageOptions(array('class' => 'image-gravatar'));

$gravatar->buildImage(); // return: <img src='https://www.gravatar.com/avatar/dfeea822891ef9e6df82ec9f4a74cf8d?s=80&d=mm&r=g' class="image-gravatar"/>
```
