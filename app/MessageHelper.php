<?php

namespace App;

final class MessageHelper 
{
    private static $messageConstants = [
        'ActionSuccess' => 'This action was successful.',
        'ActionWarning' => 'Warning! There was some problem!',
        'ActionDanger' => 'Fail! Please try again.',
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

    private static $messageTitle = [
        'success' => 'Success!',
        'warning' => 'Warning!',
        'danger' => 'Error!'
    ];

    private static function CreateMessage($type, $message)
    {
        $toastMessage = [
            'flashType' => $type,
            'flashTitle' => self::$messageTitle[$type],
            'flashMessage' => $message
        ];
        return $toastMessage;
    }

    private static function IsGenericMessage($message)
    {
        return array_key_exists($message, self::$messageConstants);
    }
    
    private static function ValidateMessage($message = null, $messageType)
    {
        if (!$message)
        {
            //generic success, warning or danger
            $message = self::$messageConstants[$messageType];
            return $message;
        }
        else if ($message && self::IsGenericMessage($message))
        {
            //generic custom message types
            $message = self::$messageConstants[$message];
            return $message;
        }
        //custom message
        return $message;
    }

    public static function Success($message = null)
    {
        $validatedMessage = self::ValidateMessage($message, 'ActionSuccess');
        $generatedMessage = self::CreateMessage('success', $validatedMessage);
        return $generatedMessage;
    }

    public static function Warning($message = null)
    {
        $validatedMessage = self::ValidateMessage($message, 'ActionWarning');
        $generatedMessage = self::CreateMessage('warning', $validatedMessage);
        return $generatedMessage;
    }

    public static function Error($message = null)
    {
        $validatedMessage = self::ValidateMessage($message, 'ActionDanger');
        $generatedMessage = self::CreateMessage('danger', $validatedMessage);
        return $generatedMessage;
    }

}