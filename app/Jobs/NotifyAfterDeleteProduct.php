<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Subscription;
use App\Notifications\FirebasSMSNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyAfterDeleteProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   
    public function __construct() {}

    
    public function handle()
    {
        try {

            $products = Product::with('owner:id,prefered_language,fcm_device_token')
                ->whereDate('created_at', Carbon::now()->subDays(30))
                ->get(['id', 'user_id', 'name_ar', 'name_fr', 'created_at']);
            
            $products->each(function($product) {
                $messageData = getAfterDeleteProductContent(
                    $product->owner->prefered_language,
                    $product->name_ar,
                    $product->name_fr
                );

                $seller = $product->owner;

                Subscription::where('product_id', $product->id)->delete();
                $product->delete();
               
                $seller->notify(
                    new FirebasSMSNotification(
                        $messageData['title'], 
                        $messageData['message']
                    )
                );
            });

        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
