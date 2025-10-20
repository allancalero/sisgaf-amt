<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class GenerateResetUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:generate-reset-url {email : The user email} {--send : Send the reset link via mail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a password reset URL for a given user email (optionally send it)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        if ($this->option('send')) {
            $status = Password::sendResetLink(['email' => $email]);

            if ($status === Password::RESET_LINK_SENT) {
                $this->info('Reset link sent to ' . $email);
                return 0;
            }

            $this->error('Failed to send reset link: ' . $status);
            return 1;
        }

        $token = Password::createToken($user);
        $resetUrl = url(route('password.reset', $token, false)) . '?email=' . urlencode($user->email);

        $this->line($resetUrl);
        return 0;
    }
}
