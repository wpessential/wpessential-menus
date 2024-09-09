# WPEssential Menus
Help to register the menus in WordPress.

`composer require wpessential-menus`

Add the single menu to WordPress registry

```php
$menu = \WPEssential\Library\Menus::make();
$menu->add([
    'id'	=> 'primary_menu',
    'name'	=> esc_html__( 'Primary Menu', 'wpessential' ),
]);
$menu->init();
```

Add the multiple menus to WordPress registry

```php
$menu = \WPEssential\Library\Menus::make();
$menu->adds([
    'primary_menu' => esc_html__( 'Primary Menu', 'wpessential' ),
    'footer_menu'  => esc_html__( 'Footer Menu', 'wpessential' ),
]);
$menu->init();
```

Remove the single menu from WordPress registry

```php
$menu = \WPEssential\Library\Menus::make();
$menu->remove('primary_menu');
$menu->init();
```

Remove the multiple menus from WordPress registry

```php
$menu = \WPEssential\Library\Menus::make();
$menu->removes(['primary_menu']);
$menu->init();
```
