<?php
/**
 
 * Examples:
 *
 * Single Files   - AutoLoader::addFile('Item','/path/to/Item.php');
 * Multiple Files - AutoLoader::addFile(array('Item'=>'/path/to/Item.php','Model'=>'/path/to/Model.php'));
 * Whole Folders  - AutoLoader::addFolder('path');
 *
 * When adding an entire folder, each file should contain one class having the
 * same name as the file without ".php" (Item.php should contain one class Item)
 *
 */
class BenderBSAutoLoader {
    protected static $files = array();
    protected static $folders = array();

    /**
     * Register the AutoLoader on the SPL autoload stack.
     */
    public static function register()
    {
        spl_autoload_register(array('BenderBSAutoLoader', 'load'), true, true);
    }

    /**
     * Adds a (set of) file(s) for autoloading.
     *
     * Examples:
     * <code>
     *      AutoLoader::addFile('Item','/path/to/Item.php');
     *      AutoLoader::addFile(array('Item'=>'/path/to/Item.php','Model'=>'/path/to/Model.php'));
     * </code>
     *
     * @param mixed $class_name Classname or array of classname/path pairs.
     * @param mixed $file       Full path to the file that contains $class_name.
     */
    public static function addFile($class_name, $file=null)
    {
        if ($file == null && is_array($class_name)) {
            self::$files = array_merge(self::$files, $class_name);
        } else {
            self::$files[$class_name] = $file;
        }
    }

    /**
     * Adds an entire folder or set of folders for autoloading.
     *
     * Examples:
     * <code>
     *      AutoLoader::addFolder('/path/to/classes/');
     *      AutoLoader::addFolder(array('/path/to/classes/','/more/here/'));
     * </code>
     *
     * @param mixed $folder Full path to a folder or array of paths.
     */
    public static function addFolder($folder)
    {
        if ( ! is_array($folder)) {
            $folder = array($folder);
        }
        self::$folders = array_merge(self::$folders, $folder);
    }

    /**
     * Loads a requested class.
     *
     * @param string $class_name
     */
    public static function load($class_name)
    {
        if (isset(self::$files[$class_name])) {
            if (file_exists(self::$files[$class_name])) {
                require self::$files[$class_name];
                return;
            }
        } else {
            foreach (self::$folders as $folder) {
                $folder = rtrim($folder, DIRECTORY_SEPARATOR);
                $file = $folder.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $class_name).'.php';
                if (file_exists($file)) {
                    require $file;
                    return;
                }
            }
        }
       // throw new Exception("AutoLoader could not find file for '{$class_name}'.");
    }
    public static function getFolders()
    {
        return self::$folders;
    }
     public static function getFiles()
     {
        return self::$files;
    }
    public static function dump()
    {
        return [self::$files, self::$folders];
    }

}