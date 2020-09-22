<?php

namespace App\Console\Commands;

use App\User;
use App\Mail\NotifyEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notify for all users every day';

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
             // جميع ايميلات اليوزرز من اجل عمل مهمة ترسل لهم رسائل على البريد من اجل حدث معين
        //$user=User::select('email')->get();
        $emails = User::pluck('email')->toArray();
        $data=['title'=>'programming','body'=>'php'];
        foreach ($emails as $email)
        {
        //يقوم باستدعاء Mail ليقوم بارسال رسالة لكل ايميل موجود
            Mail::To($email)->send(new NotifyEmail($data));
        }
        //
    }
}
