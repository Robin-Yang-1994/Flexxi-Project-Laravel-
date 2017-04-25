<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Task;
use Mail;


class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command text';

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
        // Looking for messages according to user id and match date
        $event = Task::where('due_date', '>', DATE('now'))
//                ->orderBy('user_id')
                ->join('Users', 'Tasks.user_id', '=', 'Users.id')
                ->orderBy('due_date', 'desc')
                ->get();

        foreach ($event as $task) {

            Mail::send('emails.taskNotify',['task_info' => $task], function($message) use($task) {

                $message->from('NoReplyFlexxi@support.com');
                $message->to($task['email']);
                $message->subject($task['task_name']);
            });
        }

        if (Mail::failures()) {
            echo 'Mail not sent';
        } else {
            echo 'Mail sent successfully.';
        }
    }


}
