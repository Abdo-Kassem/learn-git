<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Subscription;
use Illuminate\Http\Request;

class InstallationSubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['package', 'product'])->get();
        return view('Admin.pages.installation-subscriptions.index', compact('subscriptions'));
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->back()->with('success', trans('backend.deleted_successfully'));
    }
}
