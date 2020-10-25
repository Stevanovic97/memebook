<?php

namespace App;

final class MessageHelper 
{
    public function __construct()
    {
        
    }

    public static function ToastMessage($status)
    {
        switch ($status) {
            case 'Success': 
            {
                return array(
                    'flashType' => 'success',
                    'flashMessage' => 'This action was successful.'
                );
            }
            case 'Warning': 
            {
                return array(
                    'flashType' => 'warning',
                    'flashMessage' => 'Warning! There was some problem!'
                );
            }
            case 'Error': 
            {
                return array(
                    'flashType' => 'error',
                    'flashMessage' => 'Fail! Please try again.'
                );
            }
            default:
            {
                return array(
                    'flashType' => 'error',
                    'flashMessage' => 'Fail! Please try again.'
                );
            }
        }
    }
}