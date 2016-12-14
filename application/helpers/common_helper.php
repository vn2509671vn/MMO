<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(! function_exists('admin_template'))
{
    function admin_template($url = '')
    {
        return base_url('templates/admin/' . $url);
    }
}

if(! function_exists('site_template'))
{
    function site_template($url = '')
    {
        return base_url('templates/site/' . $url);
    }
}

if(! function_exists('admin_url'))
{
    function admin_url($url = '')
    {
        return base_url('admin/' . $url);
    }
}

if(! function_exists('home_url'))
{
    function home_url($url = '')
    {
        return base_url($url);
    }
}

if(! function_exists('public_url'))
{
    function public_url($url = '')
    {
        return base_url('public/' . $url);
    }
}

if(! function_exists('my_encrypt'))
{
    function my_encrypt($value) {
        $CI =& get_instance();

        return strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, hash('sha256', $CI->config->item('encryption_key'), true), $value, MCRYPT_MODE_ECB)), '+/=', '-_,');
    }
}

if(! function_exists('limit'))
{
    function limit($value, $limit = 100, $end = '...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }

        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
    }
}

if(! function_exists('get_sp_image'))
{
    function get_sp_image($idsanpham)
    {
        $CI =& get_instance();
        $CI->load->model('Sanpham_model');
        $hinhanh = $CI->Sanpham_model->get_first_hinhanh($idsanpham);
        if(!empty($hinhanh))
        {
            return public_url('images/sanpham/') .$hinhanh;
        }
        else 
            return site_template('images/default_image.jpg');
    }
}

if(! function_exists('get_first_image'))
{
    function get_first_image($content)
        {
            $dom = new DOMDocument();
            $dom->loadHTML('<?xml version="1.0" encoding="utf-8"?>' . $content);
            $elems = $dom->getElementsByTagName('img');
            if ($elems->length > 0)
            {
                $node = $elems->item(0);
                $sImage = $node->getAttribute('src');
            } else {
                $sImage = site_template('images/default_image.jpg');
            }
         
            return ($sImage);
        }
}