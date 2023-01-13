<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit11e5b1480e32c8ffd43e3fc7762ccf36
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'ReallySimpleJWT\\' => 16,
        ),
        'A' => 
        array (
            'App\\Routes\\' => 11,
            'App\\Managers\\' => 13,
            'App\\Interfaces\\' => 15,
            'App\\Helpers\\' => 12,
            'App\\Factories\\' => 14,
            'App\\Entities\\' => 13,
            'App\\Controllers\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ReallySimpleJWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/rbdwllr/reallysimplejwt/src',
        ),
        'App\\Routes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Routes',
        ),
        'App\\Managers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Managers',
        ),
        'App\\Interfaces\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Interfaces',
        ),
        'App\\Helpers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Helpers',
        ),
        'App\\Factories\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Factories',
        ),
        'App\\Entities\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Entities',
        ),
        'App\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit11e5b1480e32c8ffd43e3fc7762ccf36::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit11e5b1480e32c8ffd43e3fc7762ccf36::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit11e5b1480e32c8ffd43e3fc7762ccf36::$classMap;

        }, null, ClassLoader::class);
    }
}