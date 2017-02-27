# Imagens do Gravatar com PHP

Biblioteca para pesquisar e obter imagens cadastradas no serviço Gravatar.


### Instalação 

```php

composer require diego-brocanelli/image-gravatar-php dev-master

```

### Obtendo URL da imagem

```php

<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Image;

$email = 'hackershousebr@gmail.com';
$gravatar = new Image($email);

$url = $gravatar->buildURL(); // return: https://www.gravatar.com/avatar/dfeea822891ef9e6df82ec9f4a74cf8d?s=80&d=mm&r=g

```

### Obtendo uma imagem

```php

<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Image;

$email = 'hackershousebr@gmail.com';
$gravatar = new Image($email);

$image = $gravatar->buildImage(); // return: <img src='https://www.gravatar.com/avatar/dfeea822891ef9e6df82ec9f4a74cf8d?s=80&d=mm&r=g'/>

```

# Configurações

### Image Size

Pode ser utilizado entre 1px - 2048px, por default  utilizado 80px;

#### Exemplo:
```php
<?php
require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Image;

$email = 'hackershousebr@gmail.com';
$gravatar = new Image($email);

$gravatar->setImageSize(200); // return image 200px
```

### Image Set

Temos a disposição as seguintes opções [ 404 | mm | identicon | monsterid | wavatar ] por padrão é utilizada 'mm'.

#### Exemplo:
```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Image;

$email = 'hackershousebr@gmail.com';
$gravatar = new Image($email);

$gravatar->setImageSet('wavatar');
```

### Maximum rating

Temos a disposição as seguintes opções [ g | pg | r | x ] por padrão é utilizada 'g'.

#### Exemplo:
```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Image;

$email = 'hackershousebr@gmail.com';
$gravatar = new Image($email);

$gravatar->setMaxRating('pg');
```

### Image Options

Podemos incluir atributos em nossa imagem, facilitando assim seu uso, no exemplo abaixo é inserido a classe CSS 'image-gravatar'

#### Exemplo:
```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use DiegoBrocanelli\Gravatar\Image;

$email = 'hackershousebr@gmail.com';
$gravatar = new Image($email);

$gravatar->setImageOptions(array('class' => 'image-gravatar'));

$gravatar->buildImage(); // return: <img src='https://www.gravatar.com/avatar/dfeea822891ef9e6df82ec9f4a74cf8d?s=80&d=mm&r=g' class="image-gravatar"/>
```
