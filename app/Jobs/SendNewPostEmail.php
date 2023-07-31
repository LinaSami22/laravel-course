<?php

namespace App\Jobs;

use App\Mail\NewPostEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNewPostEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $incoming;

    /**
     * Create a new job instance.
     */
    public function __construct($incoming)
    {
        $this->incoming = $incoming;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->incoming['sendTo'])->send(new NewPostEmail(['name' => $this->incoming['name'], 'title' => $this->incoming['title']]));
    }

    /*
    handle => معناه انه الدالة م بتعيد اي قيمة
    Mail::to($this->incoming['sendTo'])->send => بستخدمه لارسال البريد الالكتروني و بحدد عنوان المستلم الي بدي ارسل الو 
    
    send(new NewPostEmail(['name' => $this->incoming... =>
    هان اعطيتو اسم الفايل بمرر مصفوفة مع البيانات المطلوبة للبريد الالكتروني الاسم و عنوان 
    */
}
