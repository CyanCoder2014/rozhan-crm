<?php

namespace App\Console\Commands;

use App\Notifications\MessageNotification;
use App\Notifications\TemplateNotification;
use App\Reminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder Command';

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
     * @return mixed
     */
    public function handle()
    {
        $reminders = Reminder::where('execute_at','<=',Carbon::now())->where('status',Reminder::created_status)->get();
        foreach ($reminders as $reminder)
        {
            $reminder->receiver->notify(new TemplateNotification('Reminder',$reminder->getNotifyType(),'','','',$reminder->title,$reminder->description));
            $reminder->status =Reminder::executed_status;
            $reminder->save();

        }
    }
}
