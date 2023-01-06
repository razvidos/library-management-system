<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;

class SinglePageController extends Controller
{
    public const INVALID_LOCALE_CODE = 400;

    /**
     * @param string $locale
     * @return Factory|View|Application
     */
    public function index(string $locale): Factory|View|Application
    {
        if (!in_array($locale, config('app.available_locales'), true)) {
            abort(self::INVALID_LOCALE_CODE);
        }

        App::setLocale($locale);

        return view('home');
    }

    /**
     * @return Redirector|Application|RedirectResponse
     */
    public function defaultRedirect(): Redirector|Application|RedirectResponse
    {
        $locale = App::getLocale() ?: config('app.locale', 'en');
        $route = '/' . $locale . '/';
        return redirect($route);
    }
}
