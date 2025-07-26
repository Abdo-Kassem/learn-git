<?php

namespace App\Jobs;

use App\Models\Product;
use App\Notifications\FirebasSMSNotification;
use App\Traits\FindUsersByProductSearchHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNewProductFirebasNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable,
        SerializesModels, FindUsersByProductSearchHistory;

    public $tries = 3; 
    protected $product;
   
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    
    public function handle()
    {
        try {
            $users = $this->getUsersByProductSearchHistory($this->product);

            if ($users->count() > 0) {
                foreach ($users as $user) {
                    $notificationContent = getNewProductEmailContent($user->prefered_language);
                    $user->notify(new FirebasSMSNotification(
                        $notificationContent['email_header'],
                        $notificationContent['email_description1'])
                    );
                }
            }
            //Log::info($users->count());
            //Log::info($this->product);
        } catch (\Exception $e) {
            Log::error("Failed to send notification: " . $e->getMessage());
        }
    }
}
