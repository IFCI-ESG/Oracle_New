<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\YourModel;  
use Log;

class DailyTask extends Command
{
     
    protected $signature = 'daily:task';
    
    protected $description = 'Run the FinalInsertCorp method daily at 7:30 PM';

    public function handle()
    {
        try {
            $controller = new \App\Http\Controllers\Admin\CompanyBulkUploadController();
            $result = $controller->FinalInsertCorp();
            Log::info($result);

        } catch (\Exception $e) {
            Log::error('Error while running daily task: ' . $e->getMessage());
        }
    }
}
