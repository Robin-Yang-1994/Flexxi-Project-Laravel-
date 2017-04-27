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
    protected $signature = 'send:emails'; // artisan active command name

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
                ->join('Users', 'Tasks.user_id', '=', 'Users.id')
                ->orderBy('due_date', 'desc')
                ->get();

        foreach ($event as $task) { // loop to sending emails

            Mail::send('emails.taskNotify',['task_info' => $task], function($message) use($task) { // send email command

                $message->from('NoReplyFlexxi@support.com'); // email from
                $message->to($task['email']); // user email
                $message->subject($task['task_name']); // subject name as task name
            });
        }

        if (Mail::failures()) {  // email validation check
            echo 'Mail not sent';
        } else {
            echo 'Mail sent successfully.';
        }
    }


}
