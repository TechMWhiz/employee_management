<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use App\Mail\RegistrationSuccessMail;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function afterCreate(): void
    {
        $employee = $this->record;

        try {
            Mail::to($employee->email)->send(new RegistrationSuccessMail($employee));

            Log::info('Sent registration success email to employee.', [
                'to' => $employee->email,
                'employee_id' => $employee?->getKey(),
            ]);

            Notification::make()
                ->title('Employee created and email sent')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Log::error('Failed to send registration email.', [
                'employee_to' => $employee?->email,
                'employee_id' => $employee?->getKey(),
                'error' => $e->getMessage(),
            ]);

            Notification::make()
                ->title('Employee created, but email sending failed')
                ->danger()
                ->send();
        }
    }
}
