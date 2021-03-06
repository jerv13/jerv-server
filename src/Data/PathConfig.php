<?php

namespace Jerv\ServerEnvironment\Data;

use Jerv\ServerEnvironment\Exception\ServerException;

/**
 * Class PathData
 */
class PathConfig implements Data
{
    const PATH_DEFAULT = __DIR__ . '/../../../../../config';

    protected static $pathConfig;

    /**
     * @return void
     * @throws ServerException
     */
    protected static function assertBuilt()
    {
        if (empty(self::$pathConfig)) {
            throw new ServerException(get_class(self::class) . ' must be built on bootstrap');
        }
    }

    /**
     * @param string $pathConfig
     *
     * @return void
     * @throws ServerException
     */
    public static function build($pathConfig = self::PATH_DEFAULT)
    {
        if (!empty(self::$pathConfig)) {
            // Only build once
            return;
        }

        if (empty($pathConfig)) {
            // Build default
            $pathConfig = realpath(self::PATH_DEFAULT);
        }

        if (empty($pathConfig)) {
            // No Config folder
            throw new ServerException('No config folder defined');
        }

        self::$pathConfig = $pathConfig;
    }

    /**
     * @return null|string
     * @throws ServerException
     */
    public static function get()
    {
        self::assertBuilt();

        return self::$pathConfig;
    }
}
