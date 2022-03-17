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
        return $symbol . number_format($number, $decimals);
    }
}

if (!function_exists('class_status')) {

    /**
     * class_status data
     *
     * @param
     * @return
     */
    function class_status($status)
    {
        $status = ucwords($status);
        $data = [
            "Unpaid" => "danger",
            "Checking" => "info",
            "Process" => "primary",
            "Shipping" => "warning",
            "Success" => "success",
            "Expired" => "secondary"
        ];

        return isset($data[$status]) ? $data[$status] : 'secondary';
    }
}
