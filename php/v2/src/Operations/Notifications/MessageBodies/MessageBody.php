<?php

namespace NW\WebService\Operations\Notifications\MessageBodies;

abstract class MessageBody
{
    protected const array REQUIREMENTS = [
        'complaintId'       => 'int',
        'complaintNumber'   => 'string',
        'creatorId'         => 'int',
        'creatorName'       => 'string',
        'expertId'          => 'int',
        'expertName'        => 'string',
        'clientId'          => 'int',
        'clientIdName'      => 'string',
        'consumptionId'     => 'int',
        'consumptionNumber' => 'string',
        'agreementNumber'   => 'string',
        'date'              => 'string',
    ];

    protected function __construct(
        protected int $complaintId,
        protected string $complaintNumber,
        protected int $creatorId,
        protected string $creatorName,
        protected int $expertId,
        protected string $expertName,
        protected int $clientId,
        protected string $clientIdName,
        protected int $consumptionId,
        protected string $consumptionNumber,
        protected string $agreementNumber,
        protected string $date,
        protected array $differences,
    ) {
    }

    abstract public static function createFrom(array $data): MessageBody;

    public function toArray(): array
    {
        return [
            'COMPLAINT_ID'       => $this->complaintId,
            'COMPLAINT_NUMBER'   => $this->complaintNumber,
            'CREATOR_ID'         => $this->creatorId,
            'CREATOR_NAME'       => $this->creatorName,
            'EXPERT_ID'          => $this->expertId,
            'EXPERT_NAME'        => $this->expertName,
            'CLIENT_ID'          => $this->clientId,
            'CLIENT_NAME'        => $this->clientIdName,
            'CONSUMPTION_ID'     => $this->consumptionId,
            'CONSUMPTION_NUMBER' => $this->consumptionNumber,
            'AGREEMENT_NUMBER'   => $this->agreementNumber,
            'DATE'               => $this->date,
            'DIFFERENCES'        => $this->differences,
        ];
    }

    public function getComplaintId(): int
    {
        return $this->complaintId;
    }

    public function getComplaintNumber(): string
    {
        return $this->complaintNumber;
    }

    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    public function getCreatorName(): string
    {
        return $this->creatorName;
    }

    public function getExpertId(): int
    {
        return $this->expertId;
    }

    public function getExpertName(): string
    {
        return $this->expertName;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getClientIdName(): string
    {
        return $this->clientIdName;
    }

    public function getConsumptionId(): int
    {
        return $this->consumptionId;
    }

    public function getConsumptionNumber(): string
    {
        return $this->consumptionNumber;
    }

    public function getAgreementNumber(): string
    {
        return $this->agreementNumber;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getDifferences(): array
    {
        return $this->differences;
    }


}
