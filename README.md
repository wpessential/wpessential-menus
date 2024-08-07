# wpessential-menus
WPEssential Menus helping the menus registry in WordPress.

`composer require wpessential-menus`

Add the menu to WordPress registry

```php
use WPEssential\Library\Menus;


$menu = Menus::make();
$menu->add([
    'primary_menu' => esc_html__( 'Primary Menu', 'wpessential' ),
    'footer_menu'  => esc_html__( 'Footer Menu', 'wpessential' ),
]);
$menu->init();
```

Remove the images from WordPress registry

```php
use WPEssential\Library\Menus;

$menu = Menus::make();
$menu->remove('primary_menu');
$menu->init();
```
