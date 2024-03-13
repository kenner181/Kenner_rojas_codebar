<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2598d762848fe37bd0c536bf480a4ed9
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vendor\\CreacionBarcode\\' => 23,
        ),
        'P' => 
        array (
            'Picqer\\Barcode\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vendor\\CreacionBarcode\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Picqer\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/picqer/php-barcode-generator/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2598d762848fe37bd0c536bf480a4ed9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2598d762848fe37bd0c536bf480a4ed9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2598d762848fe37bd0c536bf480a4ed9::$classMap;

        }, null, ClassLoader::class);
    }
}
