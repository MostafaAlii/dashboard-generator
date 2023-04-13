<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc5ffd58e636b3e3fddccc1d00c8b0b9c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitc5ffd58e636b3e3fddccc1d00c8b0b9c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc5ffd58e636b3e3fddccc1d00c8b0b9c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc5ffd58e636b3e3fddccc1d00c8b0b9c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}