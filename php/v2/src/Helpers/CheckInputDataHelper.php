<?php

namespace NW\WebService\Helpers;

use NW\WebService\Exceptions\IncorrectInputDataException;

class CheckInputDataHelper
{
    /**
     * @param array $requirements
     * @param array $data
     * @return array
     * @throws IncorrectInputDataException
     */
    public static function byRequirements(array $requirements, array $data): array
    {
        $filteredData = [];
        foreach ($requirements as $field => $type) {
            if (!isset($data[$field])) {
                throw new IncorrectInputDataException(sprintf('Not found param: %s', $field));
            }

            if ($type === 'int' and is_numeric($data[$field])) {
                $filteredData[$field] = (int) $data[$field];
            } elseif ($type === 'string' and is_string($data[$field])) {
                $filteredData[$field] = $data[$field];
            } else {
                throw new IncorrectInputDataException(sprintf('Incorrect param %s: %s', $field, $data[$field]));
            }
        }

        return $filteredData;
    }
}
