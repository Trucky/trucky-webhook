<?php

use Illuminate\Support\Facades\Route;
use Trucky\Webhook\Http\Controllers\TruckyWebhookController;

Route::post(config("trucky-webhook.route"), [TruckyWebhookController::class, "handleWebhook"]);