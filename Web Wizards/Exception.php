<?php

namespace PHPMailer\PHPMailer;

/**
 * PHPMailer exception handler.
 */
class Exception extends \Exception
{
    /**
     * Constructor for PHPMailer exception class.
     *
     * @param string $message Error message
     * @param int $code Error code (optional)
     */
    public function __construct($message = "", $code = 0)
    {
        // Call the parent constructor to initialize the exception object
        parent::__construct($message, $code);
    }

    /**
     * Get detailed error message.
     *
     * @return string
     */
    public function errorMessage()
    {
        // Customize the error message as needed
        return 'Mailer Error: ' . $this->getMessage();
    }
}
