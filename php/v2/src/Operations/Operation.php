<?php

namespace NW\WebService\Operations;

use NW\WebService\Exceptions\ClientNotFoundException;
use NW\WebService\Exceptions\CreatorNotFoundException;
use NW\WebService\Exceptions\ExpertNotFoundException;
use NW\WebService\Exceptions\ResellerNotFoundException;
use NW\WebService\Exceptions\UnknownOperationException;
use NW\WebService\Operations\Notification\NewReturn_NotificationOperation;
use NW\WebService\Operations\Notification\NotificationOperation;
use NW\WebService\Operations\Notification\ReturnStatusChanged_NotificationOperation;

abstract class Operation
{

    /**
     * @param array $data
     */
    public function __construct(protected array $data)
    {
    }

    /**
     * @return array
     * @throws ClientNotFoundException
     * @throws CreatorNotFoundException
     * @throws ExpertNotFoundException
     * @throws ResellerNotFoundException
     */
    abstract public function process(): array;

    /**
     * @param array $data
     * @return static
     * @throws UnknownOperationException
     */
    public static function init(array $data): static
    {
        if (isset($data['notificationType'])) {
            return match ($data['notificationType']) {
                NotificationOperation::TYPE_NEW_RETURN            => new NewReturn_NotificationOperation($data),
                NotificationOperation::TYPE_RETURN_STATUS_CHANGED => new ReturnStatusChanged_NotificationOperation($data),
                default                                           => throw new UnknownOperationException()
            };
        }

        throw new UnknownOperationException();
    }

    /**
     * @param array $data
     * @return array
     * @throws ClientNotFoundException
     * @throws CreatorNotFoundException
     * @throws ExpertNotFoundException
     * @throws ResellerNotFoundException
     * @throws UnknownOperationException
     */
    public static function handle(array $data): array
    {
        $operation = self::init($data);

        return $operation->process();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
