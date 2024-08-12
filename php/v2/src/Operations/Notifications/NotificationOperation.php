<?php

namespace NW\WebService\Operations\Notification;

use NW\WebService\Actors\Client;
use NW\WebService\Actors\Creator;
use NW\WebService\Actors\Expert;
use NW\WebService\Actors\Reseller;
use NW\WebService\Exceptions\ClientNotFoundException;
use NW\WebService\Exceptions\CreatorNotFoundException;
use NW\WebService\Exceptions\ExpertNotFoundException;
use NW\WebService\Exceptions\ResellerNotFoundException;
use NW\WebService\Operations\Operation;

abstract class NotificationOperation extends Operation
{
    public const int TYPE_NEW_RETURN            = 1;
    public const int TYPE_RETURN_STATUS_CHANGED = 2;

    protected const array REQUIREMENTS = [
        'notificationType'  => 'int',
        'resellerId'        => 'int',
        'complaintId'       => 'int',
        'complaintNumber'   => 'string',
        'creatorId'         => 'int',
        'expertId'          => 'int',
        'clientId'          => 'int',
        'consumptionId'     => 'int',
        'consumptionNumber' => 'string',
        'agreementNumber'   => 'string',
        'date'              => 'string',
    ];

    protected Reseller $reseller;
    protected Expert   $expert;
    protected Creator  $creator;
    protected Client   $client;

    /**
     * @param array $data
     * @return void
     * @throws ClientNotFoundException
     * @throws CreatorNotFoundException
     * @throws ExpertNotFoundException
     * @throws ResellerNotFoundException
     */
    protected function initActors(array $data): void
    {
        $this->reseller = Reseller::load($data['resellerId']);
        $this->client   = Client::load($data['clientId']);
        $this->creator  = Creator::load($data['creatorId']);
        $this->expert   = Expert::load($data['expertId']);
    }
}
