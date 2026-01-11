<?php

namespace App\Mail\Transports;

use App\Models\MailLog;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\MessageConverter;

class DatabaseTransport extends AbstractTransport
{
    public function __construct(EventDispatcherInterface $dispatcher = null, LoggerInterface $logger = null)
    {
        parent::__construct($dispatcher, $logger);
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        $headers = [];
        foreach ($email->getHeaders()->all() as $header) {
            $headers[$header->getName()] = $header->getBodyAsString();
        }

        MailLog::create([
            'from' => $this->formatAddress($email->getFrom()),
            'to' => $this->formatAddress($email->getTo()),
            'cc' => $this->formatAddress($email->getCc()),
            'bcc' => $this->formatAddress($email->getBcc()),
            'subject' => $email->getSubject(),
            'body' => $email->getHtmlBody() ?? $email->getTextBody(),
            'headers' => $headers,
        ]);
    }

    private function formatAddress(array $addresses): string
    {
        return implode(', ', array_map(fn($addr) => $addr->getAddress(), $addresses));
    }

    public function __toString(): string
    {
        return 'db';
    }
}
