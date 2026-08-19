<?php

namespace App\Console\Commands;

use App\Models\ContactRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RestoreAppBackupCommand extends Command
{
    protected $signature = 'app:restore-backup';

    protected $description = 'Restore users and contact requests from storage/app/backup-*.json';

    public function handle(): int
    {
        $usersPath = storage_path('app/backup-users.json');
        if (is_file($usersPath)) {
            $users = json_decode((string) file_get_contents($usersPath), true) ?: [];
            foreach ($users as $user) {
                DB::table('users')->updateOrInsert(
                    ['email' => $user['email']],
                    [
                        'name' => $user['name'] ?? 'Administrator',
                        'password' => $user['password'],
                        'updated_at' => now(),
                        'created_at' => $user['created_at'] ?? now(),
                    ]
                );
            }
            $this->info('Przywrócono '.count($users).' użytkowników.');
        }

        $contactsPath = storage_path('app/backup-contacts.json');
        if (is_file($contactsPath)) {
            $contacts = json_decode((string) file_get_contents($contactsPath), true) ?: [];
            foreach ($contacts as $contact) {
                unset($contact['id']);
                ContactRequest::query()->updateOrCreate(
                    [
                        'email' => $contact['email'],
                        'created_at' => $contact['created_at'] ?? now(),
                    ],
                    $contact
                );
            }
            $this->info('Przywrócono '.count($contacts).' zapytań.');
        }

        return self::SUCCESS;
    }
}
