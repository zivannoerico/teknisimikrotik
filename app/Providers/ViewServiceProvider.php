<?php

namespace App\Providers;

use App\Models\Setting;
use Closure;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * Settings are resolved once per request (scoped) so every view shares one query
     * without leaking stale values between requests or tests.
     */
    public function register(): void
    {
        $this->app->scoped('site.settings', function (): array {
            try {
                return Schema::hasTable('settings')
                    ? Setting::all()->pluck('value', 'key')->toArray()
                    : [];
            } catch (\Throwable $e) {
                return [];
            }
        });

        $this->app->scoped('site.whatsapp-link', function (): Closure {
            $waNumber = Setting::normalizeWhatsAppNumber($this->app->make('site.settings')['whatsapp_number'] ?? null);

            return function (?string $message = null) use ($waNumber): string {
                if ($waNumber === '') {
                    return route('contact');
                }

                return 'https://wa.me/'.$waNumber.($message ? '?text='.rawurlencode($message) : '');
            };
        });
    }

    /**
     * Bootstrap services.
     *
     * Shares the website settings and a WhatsApp link builder with every view.
     * The link builder always uses the number configured in the admin settings;
     * when no number is configured it falls back to the contact page.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('siteSettings', $this->app->make('site.settings'));
            $view->with('waLink', $this->app->make('site.whatsapp-link'));
        });
    }
}
