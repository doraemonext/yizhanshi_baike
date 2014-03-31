<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('json_content'))
{
    function json_content($type, $content = '')
    {
        $return_value = array();

        if ($type == 'error')
        {
            $return_value['status'] = 'error';
        }
        elseif ($type == 'success')
        {
            $return_value['status'] = 'success';
        }

        $return_value['content'] = $content;

        return json_encode($return_value);
    }
}
