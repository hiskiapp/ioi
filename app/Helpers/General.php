<?php

if (!function_exists('pluck_id')) {

    /**
     * pluck id from object/collection
     *
     * @param
     * @return
     */
    function pluck_id($data)
    {
        $ids = [];
        foreach ($data as $row) {
            $ids[] = $row->id;
        }

        return $ids;
    }
}

if (!function_exists('pluck_id')) {

    /**
     * pluck id from object/collection
     *
     * @param
     * @return
     */
    function pluck_id($data)
    {
        $ids = [];
        foreach ($data as $row) {
            $ids[] = $row->id;
        }

        return $ids;
    }
}

if (!function_exists('format_currency')) {

    /**
     * format_currency data
     *
     * @param
     * @return
     */
    function format_currency($number, $decimals = 0)
    {
        $symbol = get_setting('format_currency', 'Rp');
        return $symbol.number_format($number, $decimals);
    }
}