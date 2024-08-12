<?php

namespace NW\WebService\Operations\Notifications\MessageBodies;

use NW\WebService\Exceptions\IncorrectInputDataException;
use NW\WebService\Helpers\CheckInputDataHelper;

final class ReturnStatusChanged_MessageBody extends MessageBody
{
    /**
     * @param array $data
     * @return ReturnStatusChanged_MessageBody
     * @throws IncorrectInputDataException
     */
    public static function createFrom(array $data): ReturnStatusChanged_MessageBody
    {
        $filteredData = CheckInputDataHelper::byRequirements(MessageBody::REQUIREMENTS, $data);
        if (!isset($data['differences'])) {
            throw new IncorrectInputDataException('Not found param: differences');
        } elseif (!is_array($data['differences'])) {
            throw new IncorrectInputDataException('Incorrect param: differences');
        }

        $differences = CheckInputDataHelper::byRequirements([
            'from' => 'int',
            'to'   => 'int',
        ], $data['differences']);

        $filteredData['differences']['FROM'] = ReturnStatus::map($differences['from']);
        $filteredData['differences']['TO']   = ReturnStatus::map($differences['to']);

        return new ReturnStatusChanged_MessageBody(...$filteredData);
    }
}
