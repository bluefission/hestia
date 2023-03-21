<?php

namespace App\Domain\Communication;

class Communication
{
    const UNSENT = 'communication_status_unsent';
    const SENT = 'communication_status_sent';
    const DELIVERED = 'communication_status_delivered';
    const READ = 'communication_status_read';

    public $communication_id;
    public $user_id;
    public $recipient_id;
    public $communication_type_id;
    public $content;
    public $communication_channel_id;
    public $communication_status_id;
}

