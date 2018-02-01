<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit12825fcf5a51e63b0af78db842d185f6
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
        'bd9634f2d41831496de0d3dfe4c94881' => __DIR__ . '/..' . '/symfony/polyfill-php56/bootstrap.php',
        'b33e3d135e5d9e47d845c576147bda89' => __DIR__ . '/..' . '/php-di/php-di/src/functions.php',
        'cea474b4340aa9fa53661e887a21a316' => __DIR__ . '/..' . '/react/promise-stream/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Util\\' => 22,
            'Symfony\\Polyfill\\Php56\\' => 23,
            'SuperClosure\\' => 13,
        ),
        'R' => 
        array (
            'React\\Stream\\' => 13,
            'React\\Promise\\Stream\\' => 21,
            'React\\Promise\\' => 14,
            'React\\EventLoop\\' => 16,
            'React\\ChildProcess\\' => 19,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
            'PhpParser\\' => 10,
            'PhpDocReader\\' => 13,
        ),
        'I' => 
        array (
            'Invoker\\' => 8,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Stream\\' => 18,
            'GuzzleHttp\\Ring\\' => 16,
            'GuzzleHttp\\' => 11,
        ),
        'D' => 
        array (
            'DI\\' => 3,
        ),
        'A' => 
        array (
            'App\\ItSafety\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Util\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-util',
        ),
        'Symfony\\Polyfill\\Php56\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php56',
        ),
        'SuperClosure\\' => 
        array (
            0 => __DIR__ . '/..' . '/jeremeamia/SuperClosure/src',
        ),
        'React\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/stream/src',
        ),
        'React\\Promise\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise-stream/src',
        ),
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'React\\EventLoop\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/event-loop/src',
        ),
        'React\\ChildProcess\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/child-process/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'PhpParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/php-parser/lib/PhpParser',
        ),
        'PhpDocReader\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-di/phpdoc-reader/src/PhpDocReader',
        ),
        'Invoker\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-di/invoker/src',
        ),
        'GuzzleHttp\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/streams/src',
        ),
        'GuzzleHttp\\Ring\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/ringphp/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'DI\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-di/php-di/src',
        ),
        'App\\ItSafety\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'E' => 
        array (
            'Evenement' => 
            array (
                0 => __DIR__ . '/..' . '/evenement/evenement/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit12825fcf5a51e63b0af78db842d185f6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit12825fcf5a51e63b0af78db842d185f6::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit12825fcf5a51e63b0af78db842d185f6::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}