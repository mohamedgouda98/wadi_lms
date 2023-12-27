<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class updateOldDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = public_path('27dumpwadilms.sql');

        $db = [
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE')
        ];

        $colname = 'Tables_in_'. $db['database'];

        $tables = DB::select('SHOW TABLES');

        foreach($tables as $table) {

            $droplist[] = $table->$colname;
        }
        if(!empty($droplist)){
            $droplist = implode(',', $droplist);

            DB::beginTransaction();
            Schema::disableForeignKeyConstraints();
            DB::statement("DROP TABLE $droplist");
            DB::commit();
            Log::info('Old Tables Was Deleted');
        }


        exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database {$db['database']} < $sql");

        $this->command->info('SQL Import Done. ');

    }

}
