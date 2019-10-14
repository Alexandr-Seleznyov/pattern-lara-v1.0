<?php

namespace App\Http\Middleware;

use App;
use Request;
use Closure;
use Carbon\Carbon;



/**
 * Class LocaleMiddleware.
 */
class LocaleMiddleware
{
//    public static $mainLanguage = 'ru'; //основной язык, который не должен отображаться в URl
//    public static $languages = ['en', 'ru', 'uk']; // Указываем, какие языки будем использовать в приложении.

    /*
     * Проверяет наличие корректной метки языка в текущем URL
     * Возвращает метку или значеие null, если нет метки
     */
    public static function getLocale()
    {
        $languages = config('app.languages', ['en']);
        $mainLanguage = config('app.main_language', 'en');

        $uri = Request::path(); //получаем URI

        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"

        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], $languages)) {

            if ($segmentsURI[0] != $mainLanguage) {
                return $segmentsURI[0];
            }

        }
        return null;
    }



    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /*
         * Locale is enabled and allowed to be changed
         */
        if (config('locale.status')) {
            if (session()->has('locale') && in_array(session()->get('locale'), array_keys(config('locale.languages')))) {

                /*
                 * Set the Laravel locale
                 */
                app()->setLocale(session()->get('locale'));

                /*
                 * setLocale for php. Enables ->formatLocalized() with localized values for dates
                 */
                setlocale(LC_TIME, config('locale.languages')[session()->get('locale')][1]);

                /*
                 * setLocale to use Carbon source locales. Enables diffForHumans() localized
                 */
                Carbon::setLocale(config('locale.languages')[session()->get('locale')][0]);

                /*
                 * Set the session variable for whether or not the app is using RTL support
                 * for the current language being selected
                 * For use in the blade directive in BladeServiceProvider
                 */
                if (config('locale.languages')[session()->get('locale')][2]) {
                    session(['lang-rtl' => true]);
                } else {
                    session()->forget('lang-rtl');
                }
            }
        } else {
            // =======================================================================================
            // Другой вариант
            // Устанавливаем язык приложения в зависимости от метки языка из URL
            // =======================================================================================
                $mainLanguage = config('app.main_language', 'en');
                $locale = self::getLocale();

                if($locale) App::setLocale($locale);

                //если метки нет - устанавливаем основной язык $mainLanguage
                else App::setLocale($mainLanguage);

                return $next($request); //пропускаем дальше - передаем в следующий посредник
            // =======================================================================================

        }


        return $next($request);
    }
}
