<?php

namespace Laravel\Larafy\Http\Controllers;

use Amcoders\Check\Everify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisan;
use DB;
use Illuminate\Support\Str;
use File;
use Session;

use Amcoders\Lpress\Lphelper;

class LarafyController extends Controller
{

    public function install()
    {


        try {
            DB::select('SHOW TABLES');
            return redirect('/404');
        } catch (\Exception $e) {
        }

        try {
            DB::connection()->getPdo();
            if (DB::connection()->getDatabaseName()) {
                return abort(404);
            } else {
                $phpversion = phpversion();
                $mbstring = extension_loaded('mbstring');
                $bcmath = extension_loaded('bcmath');
                $ctype = extension_loaded('ctype');
                $json = extension_loaded('json');
                $openssl = extension_loaded('openssl');
                $pdo = extension_loaded('pdo');
                $tokenizer = extension_loaded('tokenizer');
                $xml = extension_loaded('xml');

                $info = [
                    'phpversion' => $phpversion,
                    'mbstring' => $mbstring,
                    'bcmath' => $bcmath,
                    'ctype' => $ctype,
                    'json' => $json,
                    'openssl' => $openssl,
                    'pdo' => $pdo,
                    'tokenizer' => $tokenizer,
                    'xml' => $xml,
                ];
                return view('Larafy::requirments', compact('info'));
            }
        } catch (\Exception $e) {
            $phpversion = phpversion();
            $mbstring = extension_loaded('mbstring');
            $bcmath = extension_loaded('bcmath');
            $ctype = extension_loaded('ctype');
            $json = extension_loaded('json');
            $openssl = extension_loaded('openssl');
            $pdo = extension_loaded('pdo');
            $tokenizer = extension_loaded('tokenizer');
            $xml = extension_loaded('xml');

            $info = [
                'phpversion' => $phpversion,
                'mbstring' => $mbstring,
                'bcmath' => $bcmath,
                'ctype' => $ctype,
                'json' => $json,
                'openssl' => $openssl,
                'pdo' => $pdo,
                'tokenizer' => $tokenizer,
                'xml' => $xml,
            ];
            return view('Larafy::requirments', compact('info'));
        }
    }

    public function info()
    {

        try {
            DB::select('SHOW TABLES');
            return redirect('/404');
        } catch (\Exception $e) {

            return view('Larafy::info');
        }
    }

    public function send(Request $request)
    {

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $app_protocol = "https://";
        } else {
            $app_protocol = "http://";
        }


        $domain = strtolower(url('/'));
        $input = trim($domain, '/');
        if (!preg_match('#^http(s)?://#', $input)) {
            $input = 'http://' . $input;
        }
        $urlParts = parse_url($input);
        $domain = preg_replace('/^www\./', '', $urlParts['host']);
        $app_protocol_less_url = rtrim($domain, '/');

        $APP_NAME = Str::slug($request->app_name);
        $PUSHER_APP_KEY = $request->PUSHER_APP_KEY;
        $PUSHER_APP_CLUSTER = $request->PUSHER_APP_CLUSTER;
        $app_protocol_less_url = $app_protocol_less_url;
        $app_protocol = $app_protocol;
        $APP_URL_WITHOUT_WWW = str_replace('www.', '', url('/'));
        $txt = "APP_NAME=" . $APP_NAME . "
APP_ENV=local
APP_KEY=base64:kZN2g9Tg6+mi1YNc+sSiZAO2ljlQBfLC3ByJLhLAUVc=
APP_DEBUG=true
APP_URL=" . $request->app_url . "
APP_PROTOCOLESS_URL=" . $app_protocol_less_url . "
APP_URL_WITHOUT_WWW=" . $APP_URL_WITHOUT_WWW . "
APP_PROTOCOL=" . $app_protocol . "
MULTILEVEL_CUSTOMER_REGISTER=false
LOG_CHANNEL=stack
LOG_LEVEL=debug
DB_CONNECTION=" . $request->db_connection . "
DB_HOST=" . $request->db_host . "
DB_PORT=" . $request->db_port . "
DB_DATABASE=" . $request->db_name . "
DB_USERNAME=" . $request->db_user . "
DB_PASSWORD=" . $request->db_pass . "\n
BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120\n
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379\n
QUEUE_MAIL=off
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_TO=
MAIL_NOREPLY=
MAIL_FROM_NAME=\n
TIMEZONE=UTC
DEFAULT_LANG=en";
        File::put(base_path('.env'), $txt);
        return "Sending Credentials";
    }


    public function check()
    {

        try {
            DB::select('SHOW TABLES');
            return "Database Installing";
        } catch (\Exception $e) {
            return false;
        }
    }

    public function migrate()
    {

        ini_set('max_execution_time', '0');
        \Artisan::call('migrate:fresh');
        return "Demo Importing";
    }
    public function seed(Request $request)
    {

        return eval(base_counter('WkVkV2VtUkdUbXhhVjFGdlMxUnpaMk50VmpCa1dFcDFTVU5LUkdJeU5XNWpiVVl3WkZkNGFHUkhiSFppYmsxb1NVWnNkbVJZU1dkak1td3dXbE5DY0dONVFubGFWMFpyWlZOSk4wbEJQVDA9', 3));
    }

    public function verify($key)
    {

        return eval(base_counter('U1VOU2FtRkhWbXBoZWpCblVsaGFiR050YkcxbFZHODJVVEpvYkZreWMyOUtSM1JzWlZOck4wbEhiRzFKUTJkcldUSm9iRmt5Y3psUVdGSjVaRmRWY0VsSWMyZGFWMDV2WW5sQmFXTXpWbXBaTWxaNlkzbEpOMGxJTUdkYVYzaDZXbGh6WjFwWFRtOWllVUpHWkcxV2VXRlhXalZQYW05cllsZEdlbU15Um01YVZITm5abE5CUFE9PQ==', 3));
    }

    public function purchase()
    {

        return eval(base_counter('WkVoS05VbEljMmRTUlVrMlQyNU9iR0pIVm1wa1EyZHVWVEJvVUZaNVFsVlJWVXBOVWxaTmJrdFVjMmRqYlZZd1pGaEtkVWxJU214YVIyeDVXbGRPTUV0RFkzWk9SRUV3U25sck4wbElNR2RaTWtZd1dUSm5aMHRHZUVabFIwNXNZMGhTY0dJeU5HZEtSMVZ3U1VoeloyWlRRbmxhV0ZJeFkyMDBaMlJ0Ykd4a2VXZHVWRWRHZVZsWFdqVlBhbkIzWkZoS2FtRkhSbnBhVTJOd1QzbEJQUT09', 3));
    }

    public function purchase_check(Request $request)
    {

        return eval(base_counter('U1VOU01HRkhiSHBNVkRVeVdWZDRjRnBIUmpCYVUyZHJZMjFXZUdSWFZucGtRM2hpU1VOa2QyUllTbXBoUjBaNldsWTVhbUl5VW14S2VVRTVVR2xCYm1OdFZuaGtWMng1V2xkUmJrbEdNSEJQZVVJd1kyNXJaMlY1UVd0Wk1taHNXVEp6T1VsR2VFSmlWMDUyV2tkV2VXTXhlRVJoUjFacVlURjRSbVJ0Vm5saFYxbzFUMnB3UkdGSFZtcGhlV2RyWTIxV2VHUlhWbnBrUXpBclkwaFdlVmt5YUdoak1sWm1XVEk1YTFwVGF6ZEpSMnh0U1VObmExa3lhR3haTW5NNVVGaFNlV1JYVlhCSlNITm5ZMjFXTUdSWVNuVkpTRXBzV2tkc2VWcFhUakJMUTJ0MFVHNUtkbVJZVW14TFEyUndZbTVPTUZsWGVITk1iV3gxV20wNGJrdFVjMmRtVTBKc1lraE9iR1Y1UWxSYVdFNTZZVmM1ZFU5cWNHMWlSMFo2WVVObmJsbFhlR3hqYmxGdVRFTkNZMUZYTVdwaU1sSnNZMjVPWTFFeWFHeFpNblJqVWxoYWJHTnRiRzFsVkc4MlNrY3hhR016VG1oYU1sVndUM2xDZVZwWVVqRmpiVFJuV1cxR2FtRjVaM0JQZVVJNVNVZ3daMWt5UmpCWk1tZG5TMFZXTkZreVZuZGtSMngyWW1sQmExcFRhMmRsZVVKNVdsaFNNV050TkdkWmJVWnFZWGxuY0U5NVFqbEpRVDA5', 3));
    }
}
