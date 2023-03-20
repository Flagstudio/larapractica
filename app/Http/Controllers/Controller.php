<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    description: "Данное API позволяет пользователю работать с товарами, добавлять их в корзину, и формировать на её основе заказ.",
    title: "API документация нашего проекта",
)]
#[OA\SecurityScheme(
    securityScheme: "DeviceUUID",
    type: 'apiKey',
    description: '',
    name: "X-Device-UUID",
    in: "header"
)]
class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
}
