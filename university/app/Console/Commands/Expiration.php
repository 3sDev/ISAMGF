<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;
use Carbon\Carbon;

class Expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire Login of students every 1 minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateNow  = Carbon::now()->addHours(1)->format('Y-m-d H:i:s');
        $students = Student::where('date_token', '<', $dateNow)->get(); //collection of students

        foreach ($students as $student) {
            $student->update(['api_token' => null, 'date_token' => null, 'expires_at' => null]);
        }
    }
}
