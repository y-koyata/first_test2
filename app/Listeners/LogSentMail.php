<?php

namespace App\Listeners;

use App\Models\MailLog;
use Illuminate\Mail\Events\MessageSent;
use Symfony\Component\Mime\MessageConverter;

class LogSentMail
{
    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        $message = $event->sent;
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
}
