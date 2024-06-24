<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Request $request): void
    {
        
        //get host name
        $host = $request->schemeAndHttpHost();
        //payment keys
        Setting::Create([
            'key' => 'ARB_MODE',
            'value' => 'test',
        ]);
        Setting::Create([
            'key' => 'ARB_REDIRECT_SUCCESS',
            'value' => $host  . '/api/arb/response',
        ]);
        Setting::Create([
            'key' => 'ARB_REDIRECT_FAIL',
            'value' => $host  . '/api/arb/response',
        ]);
        //sms keys
        Setting::Create([
            'key' => 'SMS_API_KEY',
            'value' => '30EC3A0A345C3DB9C93C4E498D29532B',
        ]);
        Setting::Create([
            'key' => 'SMS_USER_SENDER',
            'value' => 'Mnjz',
        ]);
        Setting::Create([
            'key' => 'SMS_USER_NAME',
            'value' => 'mnjz',
        ]);
        Setting::Create([
            'key' => 'SMS_SEND_URL',
            'value' => 'https://private-anon-061c89e2e8-msegat.apiary-proxy.com/gw/sendsms.php',
        ]);
    }
}
