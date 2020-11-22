<?php

namespace App;

final class MessageHelper 
{
    public function __construct()
    {
        
    }

    private static $alertMessageConstants = [
        'BadRequest' => 'There was an error in your request. Please try again!',
        'NotFound' => 'Not found!',
        'CreateMemeSuccess' => 'You have successfully created meme.',
        'CreateMemeFail' => 'There was an error trying to create meme. Please try again!',
        'UpdateMemeSuccess' => 'You have successfully updated meme.',
        'UpdateMemeFail' => 'There was an error trying to update meme. Please try again!',
        'DeleteMemeSuccess' => 'You have successfully deleted selected meme.',
        'DeleteMemeFail' => 'There was an error trying to delete selected meme. Please try again!',
        'MemeReportSuccess' => 'You have successfully reported meme.',
        'MemeReportFail' => 'There was an error trying to report meme. Please try again!'
    ];

    private static $titles = [
        'success' => 'Success!',
        'info' => 'Info!',
        'warning' => 'Warning!',
        'danger' => 'Error!'
    ];

    private static $genericMessages = [
        'sucess' => 'This action was successful.',
        'warning' => 'Warning! There was some problem!',
        'danger' => 'Fail! Please try again.'
    ];

    private static function GenerateToastMessage($messageType, $messageTitle, $message)
    {
        $toastMessage = [
            'flashType' => $messageType,
            'flashTitle' => $messageTitle,
            'flashMessage' => $message
        ];
        return $toastMessage;
    }

    public static function ToastMessage($status, $customMessage = null, $message = null)
    {
        if ($customMessage == false && $message)
        {
            $message = MessageHelper::$alertMessageConstants[$message];
        }
        return MessageHelper::GenerateToastMessage($status, MessageHelper::$titles[$status],
                                           $message ? $message : MessageHelper::$genericMessages[$status]);
    }
}