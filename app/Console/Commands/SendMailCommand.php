<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:SendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '命令行-测试脚本-SendMail';

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
        //
        $content = "请访问此链接重置密码：";
        $toMail = "240151541@qq.com";
        $send = Mail::raw($content, function ($message) use ($toMail) {
            $message->subject('人事信息管理系统--密码重置-'.date("Y-m-d, H:i:s"));
            $message->to($toMail);
        });
    }
}
