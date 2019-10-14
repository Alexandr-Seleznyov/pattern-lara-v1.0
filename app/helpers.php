<?php

use App\Helpers\General\HtmlHelper;

/*
 * Global helpers file with misc functions.
 */
if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('include_route_files')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (! function_exists('home_route')) {

    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (auth()->check()) {
            if (auth()->user()->can('view backend')) {
                return 'admin.dashboard';
            } else {
                return 'frontend.user.dashboard';
            }
        }

        return 'frontend.index';
    }
}

if (! function_exists('style')) {

    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    function style($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->style($url, $attributes, $secure);
    }
}

if (! function_exists('script')) {

    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    function script($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->script($url, $attributes, $secure);
    }
}

if (! function_exists('form_cancel')) {

    /**
     * @param        $cancel_to
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_cancel($cancel_to, $title, $classes = 'btn btn-danger btn-sm')
    {
        return resolve(HtmlHelper::class)->formCancel($cancel_to, $title, $classes);
    }
}

if (! function_exists('form_submit')) {

    /**
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_submit($title, $classes = 'btn btn-success btn-sm pull-right')
    {
        return resolve(HtmlHelper::class)->formSubmit($title, $classes);
    }
}

if (! function_exists('get_user_timezone')) {

    /**
     * @return string
     */
    function get_user_timezone()
    {
        if (auth()->user()) {
            return auth()->user()->timezone;
        }

        return 'UTC';
    }
}


function getSliderTest() {
    return [
        [
            "title" => "Готовимся к Лету",
            "subtitle" => "Акция действует в период с 15 сентября до 15 октабря 2018 года.",

            "img" => "one.png",
            "name" => "Купальник монокини...",
            "price" => "2500 ₴"
        ],
        [
            "title" => "Новая Летняя Коллекция",
            "subtitle" => "Акция действует в период с 15 сентября до 15 октабря 2018 года.",
            "img" => "two.png",
            "name" => "Купальник раздельный...",
            "price" => "1500 ₴"
        ],
        [
            "title" => "#maisonclose -50%",
            "subtitle" => "Все самое красивое в Black Lace Boutique!",
            "img" => "three.png",
            "name" => "Купальник монокини...",
            "price" => "3500 ₴"
        ],
        [
            "title" => "Black Lace Boutique!",
            "subtitle" => "Все самое красивое для тебя!",
            "img" => "four.png",
            "name" => "Купальник раздельный...",
            "price" => "1500 ₴"
        ]
    ];
}

function getCategories($category){

    $parents = $category->getArrayFilterParent(app()->getLocale(), $category->id);
    if (count($parents) == 1) {
        $parents[0]['id'] =  $category->id;
    }

    $firstParent = $parents[count($parents) - 1];
    $childsFirstParent = $category->getChilds($firstParent['id']);


    $result = [];

    $result[] = [
        'title' => 'Все товары',
        'id' => $firstParent['id'],
    ];

    foreach($childsFirstParent as $value){
        $result[] = [
            "title" => $value->meta(app()->getLocale())->title,
            'id' => $value->id,
        ];
    }

    return $result;
}

function getFilters() {
    return [
        [
            "title" => "Цельные",
            "name" => "whole",
            "list" => [
                [
                    "title" => "Классические"
                ],
                [
                    "title" => "Корректирующие"
                ],
                [
                    "title" => "Трикини"
                ],
                [
                    "title" => "Монокини"
                ],
                [
                    "title" => "Танкини"
                ]
            ]
        ],
        [
            "title" => "Раздельные",
            "name" => "separate",
            "list" => [
                [
                    "title" => "Бандо"
                ],
                [
                    "title" => "Плотная чашка "
                ],
                [
                    "title" => "Шортики"
                ],
            ]
        ],
        [
            "title" => "Бренд",
            "name" => "brand",
            "list" => [
                [
                    "title" => "Armani"
                ],
                [
                    "title" => "Aqua Bendita"
                ],
                [
                    "title" => "Despi"
                ],
                [
                    "title" => "SEAFOLLY, AUSTRALIA"
                ]
            ]
        ],
        [
            "title" => "Цвет",
            "name" => "color",
            "list" => [
                [
                    "title" => "Красный",
                    "color" => "#F9493A"
                ],
                [
                    "title" => "Синий",
                    "color" => "#4A90E2"
                ],
            ]
        ],
        [
            "title" => "Размер",
            "name" => "size",
            "list" => [
                [
                    "title" => "36"
                ],
                [
                    "title" => "38"
                ],
                [
                    "title" => "40"
                ],
                [
                    "title" => "46"
                ],
                [
                    "title" => "48"
                ],
            ]
        ]
    ];
}

function getProducts() {
    return [
        [
            "title" => "Купальник с плотной чашкой бандо и плавки ретро слипы",
            "tag" => "Новинка",
            "price" => "1500",
            "img" => "one-sm.png"
        ],
        [
            "title" => "Монокини с внутренней треугольной чашкой",
            "tag" => "",
            "price" => "5400",
            "img" => "four-sm.png"
        ],
        [
            "title" => "Купальник с треугольной плотной чашкой и шнуровкой на спине плавки слипы",
            "tag" => "",
            "price" => "1400",
            "img" => "three-sm.png"
        ],
        [
            "title" => "Купальник с треугольной плотной чашкой и шнуровкой на спине плавки слипы",
            "tag" => "Скидка -15%",
            "price" => "1400",
            "img" => "two-sm.png"
        ]
    ];
}

function getTrends() {
    return [
        [
            "title" => "Лучший наряд для яркой осени",
            "img" => "1.jpg",
            "date" => "4 октября 2018"
        ],
        [
            "title" => "На всю линейку нижнего белья #maisonclose -50%",
            "img" => "2.jpg",
            "date" => "1 октября 2018"
        ],
        [
            "title" => "Коллекция кружевных моделей PilyQ ",
            "img" => "3.jpg",
            "date" => "15 августа 2018"
        ],
        [
            "title" => "Кружевной купальник с воланом от #lulifama сейчас со скидкой -30% ",
            "img" => "4.jpg",
            "date" => "15 сентября 2018"
        ],
        [
            "title" => "Роскошный белый для бархатного сентября",
            "img" => "5.jpg",
            "date" => "5 августа 2018"
        ],
        [
            "title" => "SALE SALE SALE!",
            "img" => "6.jpg",
            "date" => "5 августа 2018"
        ]
    ];
}

function getQuestions() {
    return [
        [
            "title" => "Совпадает ли ассортимент и цены с теми, что есть в ваших магазинах?",
            "text" => 'Обмен товара происходит по схеме оформления "Возврат товара" и оформления нового заказа. Порядок действий может быть любым и проходить параллельно.'
        ],
        [
            "title" => "Есть ли возможность обменять товар?",
            "text" => 'Обмен товара происходит по схеме оформления "Возврат товара" и оформления нового заказа. Порядок действий может быть любым и проходить параллельно.'
        ],
        [
            "title" => "Каким способом мне будут возвращены денежные средства?",
            "text" => 'Обмен товара происходит по схеме оформления "Возврат товара" и оформления нового заказа. Порядок действий может быть любым и проходить параллельно.'
        ],
        [
            "title" => "Что делать, если я потерял кассовый чек?",
            "text" => 'Обмен товара происходит по схеме оформления "Возврат товара" и оформления нового заказа. Порядок действий может быть любым и проходить параллельно.'
        ],
        [
            "title" => "Могу ли я примерить товар?",
            "text" => 'Обмен товара происходит по схеме оформления "Возврат товара" и оформления нового заказа. Порядок действий может быть любым и проходить параллельно.'
        ],
    ];
}