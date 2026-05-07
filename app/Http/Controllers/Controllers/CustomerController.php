use App\Http\Controllers\CustomerController;

Route::post('/register-customer', [CustomerController::class, 'submit']);
