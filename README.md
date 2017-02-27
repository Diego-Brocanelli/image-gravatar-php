# Obter imagens do Gravatar com PHP 

Biblioteca para pesquisar e obter imagens cadastradas no serviço Gravatar.


## Instalação 

```php

composer require diego-brocanelli/image-gravatar-php dev-master

```

## Obtendo URL da imagem

```php

 <?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Image;

$email = 'hackershousebr@gmail.com';
$gravatar = new Image($email);

$url = $gravatar->buildURL(); // return: https://www.gravatar.com/avatar/dfeea822891ef9e6df82ec9f4a74cf8d?s=80&d=mm&r=g

```

## Obtendo uma imagem

```php

<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Image;

$email = 'hackershousebr@gmail.com';
$gravatar = new Image($email);

 $image = $gravatar->buildImage(); // return: <img src='https://www.gravatar.com/avatar/dfeea822891ef9e6df82ec9f4a74cf8d?s=80&d=mm&r=g'/>

```

