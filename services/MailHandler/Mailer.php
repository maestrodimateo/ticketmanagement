<?php
namespace Services\MailHandler;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

abstract class Mailer
{

    protected PHPMailer $mail;

    public function __construct()
    {
        $mail = new PHPMailer(true);
    
        // Config
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = env('mail_host');
        $mail->SMTPAuth   = true;
        $mail->Username   = env('mail_username');
        $mail->Password   = env('mail_password');
        $mail->SMTPSecure = env('mail_encryption');
        $mail->Port       = (int) env('mail_port');
        $mail->setFrom(env('mail_sender'));
        $mail->CharSet = "UTF-8"; 

        //Content
        $mail->isHTML(true);
        $this->mail = $mail;        
    }

    /**
     * Set the recipients
     *
     * @param array $recipients
     * @return self
     */
    public function to(array $recipients): self
    {
        foreach ($recipients as $recipient) {
            $this->mail->addAddress($recipient);
        }
        return $this;
    }

    /**
     * Set the mail subject
     *
     * @param string $subject
     * @return self
     */
    protected function setSubject(string $subject): self
    {
        $this->mail->Subject = $subject;
        return $this;
    }

    /**
     * Set the mail body
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    protected function setBody(string $view, array $data = [])
    {
        $view_file = VIEWS . $view . '.html.php';

        $this->mail->msgHTML(get_file_content($view_file, $data));
    }


    /**
     * handle the mail to be sent
     *
     * @return void
     */
    abstract protected function handle();

    /**
     * Send the mail
     *
     * @return void
     */
    public function send()
    {
        try {
            $this->handle();
            $this->mail->send();
        } catch (\Exception $e) {
            dd("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }
}