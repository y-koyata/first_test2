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
        // The logging is now handled by the LogSentMail listener listening to MessageSent event.
        // This method simply acts as a "sink" that allows the mail process to complete successfully,
        // which then triggers the MessageSent event.
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
