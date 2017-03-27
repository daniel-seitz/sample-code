<?php

namespace App\Models;

abstract class Model
{
    protected static $db;
    protected static $table;
    protected $model;

    /**
     * Initialize
     * Constructs the table name from the Class Name being called
     */
    public static function init()
    {
        self::$db = require(__DIR__.'/../../db.php');

        $reflector = new \ReflectionClass(static::class);
        $shortClassName = $reflector->getShortName();

        self::$table = strtolower($shortClassName).'s';
    }

    /**
     * Return all Models
     *
     * @return model
     */
    public static function all()
    {
        self::init();

        return self::$db[self::$table];
    }

    /**
     * Return a specific Model
     *
     * @return model
     */
    public static function get($id)
    {
        self::init();

        foreach(self::$db[self::$table] as $key => $model) {
            if($model['id'] == $id) return $model;
        }

        throw new \Exception(404);
    }
}