<?php

namespace App\Console\Commands;

use App\Entities\User;
use Illuminate\Console\Command;

class RemoveUser extends Command
{
    protected $signature = 'user:remove {email}';

    protected $description = 'Delete user with given email';

    public function handle()
    {
        $email = $this->argument('email');

        /** @var User $user */
        if (!$user = User::where('email', $email)->first()) {
            $this->error('Пользователь с e-mail "' . $email . '" не найден.');
            return false;
        }

        if ($this->confirm('Удалить пользователя? [да|нет]'))
        {
            try {
                $user->delete();
            } catch (\Exception $exception) {
                $this->error($exception->getMessage());
                return false;
            }

            $this->info('Пользователь удален.');
            return true;
        }
    }
}
