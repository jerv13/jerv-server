<?php

namespace Jerv\ServerEnvironment\Data;

use Jerv\ServerEnvironment\Exception\ServerException;

/**
 * Class PathData
 */
class PathData implements Data
{
    const PATH_DEFAULT = __DIR__ . '/../../../../../data/_server';

    protected static $pathData;

    /**
     * @return void
     * @throws ServerException
     */
    protected static function assertBuilt()
    {
        if (empty(self::$pathData)) {
            throw new ServerException(get_class(self::class) . ' must be built on bootstrap');
        }
    }

    /**
     * @param string $pathData
     *
     * @return void
     */
    public static function build($pathData = self::PATH_DEFAULT)
    {
        if (!empty(self::$pathData)) {
            // Only build once
            return;
        }

        if (empty($pathData)) {
            // Build default
            $pathData = realpath(self::PATH_DEFAULT);
        }

        self::$pathData = $pathData;
    }

    /**
     * @return null|string
     * @throws ServerException
     */
    public static function get()
    {
        self::assertBuilt();

        return self::$pathData;
    }
}
