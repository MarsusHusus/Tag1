<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8187c1e650c343d319080fcf2f793339
{
    public static $prefixLengthsPsr4 = array (
        'l' => 
        array (
            'lib\\' => 4,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'M' => 
        array (
            'Marsushusus\\M295t3\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Marsushusus\\M295t3\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Steampixel' => 
            array (
                0 => __DIR__ . '/..' . '/steampixel/simple-php-router/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8187c1e650c343d319080fcf2f793339::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8187c1e650c343d319080fcf2f793339::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit8187c1e650c343d319080fcf2f793339::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit8187c1e650c343d319080fcf2f793339::$classMap;

        }, null, ClassLoader::class);
    }
}