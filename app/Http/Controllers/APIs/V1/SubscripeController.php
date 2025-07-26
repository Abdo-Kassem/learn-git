<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\FirebasSMSNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscripeController extends Controller
{
    public function subscripeInPackage(Request $request)
    {
        $validator = Validator::make($request->only(['product_id', 'package_id']), [
            'product_id' => 'required|exists:products,id',
            'package_id' => 'required|exists:packages,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'data' => $validator->errors()->toArray()
            ]);
        }

        $subscription = Subscription::where('product_id', $request->product_id)
            ->where('package_id', $request->package_id)->first();
        $product = Product::find($request->product_id);
        $daysNumber = Package::where('id', $request->package_id)->value('days_number');

        if ($subscription) {

            $subscription->start_at = now();
            $subscription->end_at = Carbon::now()->addDays($daysNumber);
            $subscription->is_expired = 0;
            $subscription->save();
            $message = 'Subscription Activated Successfully';

        } else {

            Subscription::create([
                'product_id' => $request->product_id,
                'package_id' => $request->package_id,
                'start_at' => now(),
                'end_at' => Carbon::now()->addDays($daysNumber)
            ]);
            $message = 'Subscription Done';

        }

        $this->sendFirebaseSMSNotification($product);

        return response()->json([
            'status' => 200,
            'success' => $message
        ]);
    }

    private function sendFirebaseSMSNotification(Product $product)
    {
        $seller = User::select(['id', 'fcm_device_token', 'prefered_language', 'first_name'])
            ->find($product->user_id);

        if ($seller->prefered_language == 'ar') {
            $title = "المنتج: " . $product->name_ar . ' تم تثبيته';
            $message = "مرحبا استاذ " . $seller->first_name . " يسعدنا ان نخبرك ان تم تثبيت المنتج: " . $product->name_ar;
        } else {
            $title = "Le produit est installé: " . $product->name_fr;
            $message = "Bonjour professeur " . $seller->first_name . " Nous sommes heureux de vous informer que le produit a été installé:" . $product->name_fr;
        }

        $seller->notify(new FirebasSMSNotification($title, $message));
    }
}
