<?php

namespace NW\WebService\Operations\Notification;

use NW\WebService\Exceptions\ClientNotFoundException;
use NW\WebService\Exceptions\CreatorNotFoundException;
use NW\WebService\Exceptions\ExpertNotFoundException;
use NW\WebService\Exceptions\IncorrectInputDataException;
use NW\WebService\Exceptions\ResellerNotFoundException;
use NW\WebService\Helpers\CheckInputDataHelper;
use NW\WebService\Operations\Notifications\MessageBodies\NewReturn_MessageBody;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Reports;
use NW\WebService\Operations\Notifications\Messages\Email\Employee\NewReturn_EmployeeEmailMessage;

final class NewReturn_NotificationOperation extends NotificationOperation
{
    /**
     * @return array[]
     * @throws ClientNotFoundException
     * @throws CreatorNotFoundException
     * @throws ExpertNotFoundException
     * @throws IncorrectInputDataException
     * @throws ResellerNotFoundException
     */
    public function process(): array
    {
        // check data
        $filteredData = CheckInputDataHelper::byRequirements(NotificationOperation::REQUIREMENTS, $this->data);

        // init actors and check them
        $this->initActors($filteredData);

        $this->data = $filteredData + $this->data;

        $reports   = new Reports();

        // send emails to employees
        $employees = $this->reseller->getEmployees();
        foreach ($employees as $employee) {
            $message = new NewReturn_EmployeeEmailMessage(
                $employee->getEmail(),
                NewReturn_MessageBody::createFrom($this->data),
                $this->reseller->getEmail()
            );
            $report  = $message->handler($employee)->handle();
            $reports->addReport($report);
        }

        return ['notifications' => $reports->toArray()];
    }
}
