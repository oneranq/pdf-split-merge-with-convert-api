<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf52e2ceaa66842dcb90ea3bd4633930e
{
    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'ConvertApi\\' => 
            array (
                0 => __DIR__ . '/..' . '/convertapi/convertapi-php/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitf52e2ceaa66842dcb90ea3bd4633930e::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}