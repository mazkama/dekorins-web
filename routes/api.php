    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\AuthController;
    use App\Http\Controllers\Api\BookController;
    use App\Http\Controllers\Api\CategoryController;
    use App\Http\Controllers\Api\DekorinController;
    use App\Http\Controllers\Api\TransactionApiController;
    use App\Http\Controllers\Api\PaymentMethodApiController;

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::put('/profile', [AuthController::class, 'updateProfile']);

        Route::get('/dekorins', [DekorinController::class, 'index']);
        Route::get('/dekorins/{id}', [DekorinController::class, 'show']);

        Route::get('/transactions', [TransactionApiController::class, 'index']);
        Route::get('/transactions/{id}', [TransactionApiController::class, 'show']);
        Route::post('/transactions', [TransactionApiController::class, 'store']);
        Route::post('/transactions/{id}/pay', [TransactionApiController::class, 'pay']);
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/payment-methods', [PaymentMethodApiController::class, 'index']);
    });