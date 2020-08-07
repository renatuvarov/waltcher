<?php

namespace App\Console\Commands;

use App\Entities\User;
use App\Mail\Admin\Created;
use Illuminate\Console\Command;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * Create admin
     *
     * @var string
     */
    protected $description = 'Create a new user';
    /**
     * @var Factory
     */
    private $validatorFactory;
    /**
     * @var Hasher
     */
    private $hasher;
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Create a new command instance.
     *
     * @param Factory $validatorFactory
     * @param Hasher $hasher
     * @return void
     */
    public function __construct(Factory $validatorFactory, Hasher $hasher, Mailer $mailer)
    {
        parent::__construct();
        $this->validatorFactory = $validatorFactory;
        $this->hasher = $hasher;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $values = $this->askQuestions();
        $this->showErrors($this->validatorFactory->make($values, $this->rules(), $this->messages()));

        $user = User::create([
            'email' => $values['email'],
            'password' => $this->hasher->make($values['password']),
            'role' => $values['role'],
        ]);

        $this->info('Пользователь создан.');

        $this->mailer->to($user->email)->send(new Created($values['email'], $values['password'], $values['role']));
    }

    /**
     * Get admin data from console.
     *
     * @return array
     */
    private function askQuestions(): array
    {
        $values = [];
        $values['email'] = $this->ask('Введите email');
        $values['password'] = $this->ask('Введите пароль (не меннее 8 символов)');
        $values['password_confirmation'] = $this->ask('Повторите пароль');
        $values['role'] = $this->ask('Роль пользователя');
        return $values;
    }

    /**
     * Displays validation errors and terminates script
     *
     * @param ValidatorContract $validator
     * @return void
     */
    private function showErrors(ValidatorContract $validator): void
    {
        if ($validator->fails()) {
            $this->error('Пользователь не создан по причине:' . PHP_EOL);

            foreach ($validator->errors()->all() as $error) {
                $this->comment($error);
            }

            die;
        }
    }

    /**
     * Rules for validation.
     *
     * @return array
     */
    private function rules(): array
    {
        $roles = implode(',', User::roles());

        return [
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required|string|min:8|max:255|same:password',
            'role' => 'required|string|in:' . $roles,
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    private function messages(): array
    {
        return [
            'email.required' => 'Email обязателен для заполнения',
            'email.string' => 'Значение поля Email  должно быть строкой',
            'email.email' => 'Некорректный адрес электронной почты',
            'email.max' => 'Email не должен превышать 255 символов',
            'email.unique' => 'Пользователь с таким Email уже существует',

            'password.required' => 'Пароль обязателен для заполнения',
            'password.string' => 'Пароль должен быть строкой',
            'password.min' => 'Пароль должен быть не короче 8 символов',
            'password.max' => 'Длина пароля не должна превышать 255 символов',

            'password_confirmation.required' => 'Вы ввели разные значения пароля',
            'password_confirmation.string' => 'Вы ввели разные значения пароля',
            'password_confirmation.min' => 'Вы ввели разные значения пароля',
            'password_confirmation.max' => 'Вы ввели разные значения пароля',
            'password_confirmation.same' => 'Вы ввели разные значения пароля',

            'role.required' => 'Роль не указана',
            'role.string' => 'Значение поля Роль должно быть строкой',
            'role.in' => 'Неизвестная роль',
        ];
    }
}
