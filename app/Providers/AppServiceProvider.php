<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $unreadMessagesCount = 0;
            $user = \Illuminate\Support\Facades\Auth::guard('nurse_middle')->user()
                ?? \Illuminate\Support\Facades\Auth::guard('healthcare_facilities')->user();

            if ($user) {
                $unreadMessagesCount = \App\Models\Message::where('is_read', 0)
                    ->where('sender_id', '!=', $user->id)
                    ->whereHas('conversation', function ($query) use ($user) {
                        $query->where('nurse_id', $user->id)
                            ->orWhere('healthcare_id', $user->id);
                    })
                    ->count();
            }

            $view->with('unreadMessagesCount', $unreadMessagesCount);
        });
    }
}
