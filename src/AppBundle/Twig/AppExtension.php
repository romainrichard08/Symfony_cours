<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getTags()
    {
        return array(
            new \Twig_SimpleFilter('getTags', array($this, 'GetTags')),
        );
    }

    // public function GetTags()
    // {
    //     // $price = number_format($number, $decimals, $decPoint, $thousandsSep);
    //     // $price = '$'.$price;
    //     //
    //     // return $price;
    // }
}
