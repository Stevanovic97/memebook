<?php

namespace App;

final class MessageHelper 
{
    public function __construct()
    {
        
    }

    public static function ToastMessage($status, $message = null)
    {
        switch ($status) {
            case 'Success': 
            {
                return array(
                    'flashType' => 'success',
                    'flashTitle' => 'Success!',
                    'flashMessage' => $message ? $message : 'This action was successful.'
                );
            }
            case 'Warning': 
            {
                return array(
                    'flashType' => 'warning',
                    'flashTitle' => 'Warning!',
                    'flashMessage' => $message ? $message : 'Warning! There was some problem!'
                );
            }
            case 'Error': 
            {
                return array(
                    'flashType' => 'error',
                    'flashTitle' => 'Error!',
                    'flashMessage' => 'Fail! Please try again.'
                );
            }
            default:
            {
                return array(
                    'flashType' => 'error',
                    'flashTitle' => 'Error!',
                    'flashMessage' => 'Fail! Please try again.'
                );
            }
        }
    }
}