<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_settings')->insert([
            [
                'type' => 'default_currencies',
                'value' => '1',
            ],
            [
                'type' => 'type_logo',
                'value' => '',
            ],
            [
                'type' => 'type_name',
                'value' => '',
            ],
            [
                'type' => 'type_footer',
                'value' => '',
            ],
            [
                'type' => 'type_mail',
                'value' => '',
            ],
            [
                'type' => 'type_address',
                'value' => '',
            ],
            [
                'type' => 'type_fb',
                'value' => '',
            ],
            [
                'type' => 'type_tw',
                'value' => '',
            ],
            [
                'type' => 'type_number',
                'value' => '',
            ],
            [
                'type' => 'type_google',
                'value' => '',
            ],
            [
                'type' => 'footer_logo',
                'value' => '',
            ],
            [
                'type' => 'favicon_icon',
                'value' => '',
            ],
            [
                'type' => 'affiliate',
                'value' => 'Inactive',
            ],
            [
                'type' => 'commission',
                'value' => '1',
            ],
            [
                'type' => 'withdraw_limit',
                'value' => '10',
            ],
            [
                'type' => 'cookies_limit',
                'value' => '10',
            ],
        ]);
    }
}
