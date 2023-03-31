<?php

namespace App\Domain\Communication\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class CommunicationModel extends Model
{
    private $attachments = [];
    private $parameters = [];

    protected $_table = ['communications'];
    protected $_fields = [
        'communication_id',
        'user_id',
        'recipient_id',
        'communication_type_id',
        'channel_id',
        'communication_content',
        'communication_status_id',
    ];

    protected $_related = [
        'users',
        'communication_parameters',
        'communication_attachments',
        'communication_types',
        'communication_channels',
        'communication_statuses',
    ];

    public function user()
    {
        return $this->ancestor('App\Domain\User\Models\UserModel', 'user_id');
    }

    public function recipient()
    {
        return $this->ancestor('App\Domain\User\Models\UserModel', 'recipient_id', 'user_id');
    }

    public function parameters()
    {
        return $this->descendents('App\Domain\Communication\Models\CommunicationParameterModel', 'communication_id');
    }

    public function attachments()
    {
        return $this->descendents('App\Domain\Communication\Models\CommunicationAttachmentModel', 'communication_id');
    }

    public function type()
    {
        return $this->ancestor('App\Domain\Communication\Models\CommunicationTypeModel', 'communication_type_id');
    }

    public function channel()
    {
        return $this->ancestor('App\Domain\Communication\Models\CommunicationChannelModel', 'communication_channel_id', );
    }

    public function communication_status()
    {
        return $this->ancestor('App\Domain\Communication\Models\CommunicationStatusModel', 'communication_status_id', );
    }

    public function addAttachments($attachments)
    {
        $this->attachments = array_merge($this->attachments, $attachments);
    }

    public function addParameters($parameters)
    {
        $this->parameters = array_merge($this->parameters, $parameters);
    }

    public function write($values = null)
    {
        parent::write($values);
        $model = new CommunicationAttachmentModel();
        foreach($this->attachments as $attachment) {
            $model->write([
                'communication_id' => $this->communication_id,
                'name' => $attachment['name'],
                'file_type' => $attachment['file_type'],
            ]);
        }
        $model = new CommunicationParameterModel();
        foreach($this->parameters as $parameter) {
            $model->write([
                'communication_id' => $this->communication_id,
                'name' => $parameter['name'],
                'value' => $parameter['value'],
            ]);
        }

        return $this;
    }
}
