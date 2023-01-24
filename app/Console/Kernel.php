<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Models\Lelang;
use App\Models\HistoryLelang;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $lelang = Lelang::join('barangs','barangs.id_barang','=','lelangs.id_barang')->where('status','dibuka')->get();
            foreach($lelang as $row){
                if (strtotime($row->tgl_ditutup) <= time()) {
                    Lelang::where('id_lelang',$row->id_lelang)->update(['status' => 'ditutup']);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
