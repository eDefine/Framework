<?php

namespace Edefine\Framework\Mail;

use Edefine\Framework\Config\Config;

/**
 * Class Mailer
 * @package Edefine\Framework\Mail
 */
class Mailer
{
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param Mail $mail
     * @return bool
     * @throws \Exception
     * @throws \phpmailerException
     */
    public function send(Mail $mail)
    {
        $phpMailer = new \PHPMailer();

        $phpMailer->isSMTP();
        $phpMailer->SMTPAuth = true;
        $phpMailer->Host = $this->config->get('mail.host');
        $phpMailer->Username = $this->config->get('mail.user');
        $phpMailer->Password = $this->config->get('mail.password');
        $phpMailer->SMTPSecure = $this->config->get('mail.secure');
        $phpMailer->Port = $this->config->get('mail.port');
        $phpMailer->From = $this->config->get('mail.from_email');
        $phpMailer->FromName = $this->config->get('mail.from_name');
        $phpMailer->isHTML(true);

        $mailBody = $mail->getBody();

        if ($this->config->get('application.environment') == 'production') {
            foreach ($mail->getRecipients() as $recipient) {
                $phpMailer->addAddress($recipient->getEmail(), $recipient->getName());
            }
        } else {
            $phpMailer->addAddress($this->config->get('mail.testing_email'));

            $mailBody .= $this->addOriginalRecipientsToBody($mail->getRecipients());
        }

        $phpMailer->Subject = $mail->getTitle();
        $phpMailer->Body = $mailBody;
        $phpMailer->AltBody = $mailBody;

        if (!$phpMailer->send()) {
            throw new \RuntimeException($phpMailer->ErrorInfo);
        }

        return true;
    }

    private function addOriginalRecipientsToBody(array $recipients)
    {
        $originalRecipients = [];
        foreach ($recipients as $recipient) {
            $originalRecipients[] = sprintf('%s (%s)', $recipient->getName(), $recipient->getEmail());
        }

        return sprintf('<p>%s</p>', implode('<br />', $originalRecipients));
    }
}