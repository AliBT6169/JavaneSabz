<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => 'مازندران - بابلسر - بهنمیر - کیلومتر 4 بلوار درزیان -سر ورودی محل گالشکلا و پارومحله',
            'phone' => '09394001870',
            'icon' => '/logo/logo1.png',
            'email' => 'MojtabaGhorbani@gmail.com',
            'about' => 'فروشگاه جوانه سبز در تلاش است تا بهترین خود را برای کشاورزان محترم بگذارد تا همیشه بتوانند سود خوبی از زمین های زراعی و باغ های خود داشته باشند خاک پای کشاورزان ',
            'facebook' => '',
            'twitter' => '',
            'instagram' => 'javane_sabz_2',
            'youtube' => '',
            'telegram' => '',
            'whatsapp' => '',
            'eta' => '',
        ];
    }
}
