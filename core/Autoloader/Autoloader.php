<?php
/**
 * Created by PhpStorm.
 * User: zhangwenzong
 * Date: 2019/1/17
 * Time: 12:01
 */

namespace core\Autoloader;

class Autoloader
{
    private static $autoloadPathArray = array(
        'core/Autoloader', 'core/Http', 'core/Regions', 'core/Profile', 'core/Exception'
    );

    /**
     *
     * @param $className
     */
    public static function autoload($className)
    {
        $directories = dirname(dirname(__DIR__));
        foreach (self::$autoloadPathArray as $path) {
            $file = $directories . DIRECTORY_SEPARATOR . $path  . '.php';
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
            if (is_file($file)) {
                include_once $file;
                break;
            }

        }
        $file = $directories.DIRECTORY_SEPARATOR.$className.'.php';
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
        if (is_file($file)) {
            include_once $file;

        }
    }

    public static function loadDirectories()
    {
        $directories = dirname(dirname(__DIR__));
        foreach (glob($directories . DIRECTORY_SEPARATOR . '*') as $directory) {
            if (is_dir($directory) && basename($directory) !== 'core') {
                self::$autoloadPathArray[] = basename($directory);
            }
        }
    }

    public static function addAutoloadPath($path)
    {
        self::$autoloadPathArray[] = $path;
    }
}

spl_autoload_register(['core\Autoloader\Autoloader', 'autoload'], true, true);

