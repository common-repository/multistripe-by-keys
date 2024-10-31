<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes;

class MSBK_Init
{
    /**
     * Get the list of services to register
     */
    public static function get_services()
    {
        return [
            Admin\MSBK_Admin::class,
            Admin\MSBK_Vendors::class,
            Base\MSBK_Enqueue::class,
            Base\MSBK_SettingsLink::class,
            Core\MSBK_Core::class
        ];
    }

    /**
     * Call the register method of a class
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Create an instance of a class
     */
    private static function instantiate($class)
    {
        $service = new $class();
        return $service;
    }
}
