<?php

if (! function_exists('RouteMapperByArray'))
{
    /**
     * generate routes by each given mapper array
     *
     * @param array $mappers
     * @param $controller
     */
    function RouteMapperByArray(array $mappers, $controller, array $mapParams = [], $method = 'get')
    {
        $mapParams = (array) $mapParams;
        if ($mapParams != []) {
            foreach ($mapParams as $mapParam) {
                Route::$method('/' . $mapParam . '{' . $mapParam . '}', ['as' => $mapParam, 'uses' => $controller . '@' . $mapParam]);
            }
        }
        foreach ($mappers as $mapper) {
            Route::$method('/' . $mapper, ['as' => $mapper, 'uses' => $controller . '@' . $mapper]);
        }
    }
}