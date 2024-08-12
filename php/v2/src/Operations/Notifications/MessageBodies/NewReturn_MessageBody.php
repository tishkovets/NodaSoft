<?php

namespace NW\WebService\Operations\Notifications\MessageBodies;

use NW\WebService\Exceptions\IncorrectInputDataException;
use NW\WebService\Helpers\CheckInputDataHelper;

final class NewReturn_MessageBody extends MessageBody
{
    /**
     * @param array $data
     * @return NewReturn_MessageBody
     * @throws IncorrectInputDataException
     */
    public static function createFrom(array $data): NewReturn_MessageBody
    {
        $filteredData                = CheckInputDataHelper::byRequirements(MessageBody::REQUIREMENTS, $data);
        $filteredData['differences'] = [];

        return new NewReturn_MessageBody(...$filteredData);
    }
}
