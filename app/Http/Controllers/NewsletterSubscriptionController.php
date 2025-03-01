<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterSubscriptionController extends Controller
{
    public function index()
    {
        return response()->json(NewsletterSubscription::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscribed' => 'required|boolean'
        ]);

        $subscription = NewsletterSubscription::create($data);
        return response()->json($subscription, 201);
    }

    public function show(NewsletterSubscription $newsletterSubscription)
    {
        return response()->json($newsletterSubscription);
    }

    public function update(Request $request, NewsletterSubscription $newsletterSubscription)
    {
        $data = $request->validate([
            'subscribed' => 'boolean'
        ]);

        $newsletterSubscription->update($data);
        return response()->json($newsletterSubscription);
    }

    public function destroy(NewsletterSubscription $newsletterSubscription)
    {
        $newsletterSubscription->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
