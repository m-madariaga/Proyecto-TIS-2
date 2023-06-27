<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransbankController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller\RolesController;
use App\Http\Controllers\Controller\PermissionsController;
use App\Http\Controllers\Controller\CityController;
use App\Http\Controllers\Controller\RegionController;
use App\Http\Controllers\Controller\CountryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PurcharseOrderController;
use App\Http\Controllers\PurcharseOrderProductController;
use App\Http\Controllers\ShipmentTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileLandingController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\WebpayCredentialController;
use App\Http\Controllers\PointOfSaleController;
use App\Http\Controllers\BankDataController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ProductDesiredController;
use App\Http\Controllers\ShippingMethodsController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ActionController;
use App\Models\Purchase_order_product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/',[App\Http\Controllers\HomeLandingController::class, 'index']);

Route::get('/home-landing',[App\Http\Controllers\HomeLandingController::class, 'index'])->name('home-landing');


// rutas categorias
Route::get('/mujer', [App\Http\Controllers\ProductController::class, 'women_product'])->name('women');
Route::get('/hombre', [App\Http\Controllers\ProductController::class, 'men_product'])->name('men');
Route::get('/niños', [App\Http\Controllers\ProductController::class, 'kids_product'])->name('kids');
Route::get('/accesorios', [App\Http\Controllers\ProductController::class, 'accesorie_product'])->name('accesorie');

Route::get('regions/{countryId}', [App\Http\Controllers\RegionController::class, 'getRegions']);
Route::get('cities/{regionId}', [App\Http\Controllers\CityController::class, 'getCities']);

Route::group(['middleware' => ['permission:vista admin'], 'prefix' => 'admin'], function () {
    //insertar rutas de admin aqui

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile_edit/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile_edit');

    Route::get('/countries/create', [App\Http\Controllers\CountryController::class, 'create'])->name('countries.create');
    Route::post('/countries', [App\Http\Controllers\CountryController::class, 'store'])->name('countries.store');
    Route::get('/countries/{id}/edit', [App\Http\Controllers\CountryController::class, 'edit'])->name('countries.edit');
    Route::put('/countries/{id}', [App\Http\Controllers\CountryController::class, 'update'])->name('countries.update');
    Route::delete('/countries/{id}', [App\Http\Controllers\CountryController::class, 'destroy'])->name('countries.destroy');
    Route::get('/countries', [App\Http\Controllers\CountryController::class, 'index'])->name('countries.index');

    Route::get('/regions/create', [App\Http\Controllers\RegionController::class, 'create'])->name('regions.create');
    Route::post('/regions', [App\Http\Controllers\RegionController::class, 'store'])->name('regions.store');
    Route::get('/regions/{id}/edit', [App\Http\Controllers\RegionController::class, 'edit'])->name('regions.edit');
    Route::put('/regions/{id}', [App\Http\Controllers\RegionController::class, 'update'])->name('regions.update');
    Route::delete('/regions/{id}', [App\Http\Controllers\RegionController::class, 'destroy'])->name('regions.destroy');
    Route::get('/regions', [App\Http\Controllers\RegionController::class, 'index'])->name('regions.index');

    Route::get('/cities/create', [App\Http\Controllers\CityController::class, 'create'])->name('cities.create');
    Route::post('/cities', [App\Http\Controllers\CityController::class, 'store'])->name('cities.store');
    Route::get('/cities/{id}/edit', [App\Http\Controllers\CityController::class, 'edit'])->name('cities.edit');
    Route::put('/cities/{id}', [App\Http\Controllers\CityController::class, 'update'])->name('cities.update');
    Route::delete('/cities/{id}', [App\Http\Controllers\CityController::class, 'destroy'])->name('cities.destroy');
    Route::get('/cities', [App\Http\Controllers\CityController::class, 'index'])->name('cities.index');


    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('/shipment_types', [App\Http\Controllers\ShipmentTypeController::class, 'index'])->name('shipment_types.index');
    Route::get('/shipment_types/create', [App\Http\Controllers\ShipmentTypeController::class, 'create'])->name('shipment_types.create');
    Route::post('/shipment_types', [App\Http\Controllers\ShipmentTypeController::class, 'store'])->name('shipment_types.store');
    Route::get('/shipment_types/{id}/edit', [App\Http\Controllers\ShipmentTypeController::class, 'edit'])->name('shipment_types.edit');
    Route::put('/shipment_types/{id}', [App\Http\Controllers\ShipmentTypeController::class, 'update'])->name('shipment_types.update');
    Route::delete('/shipment_types/{id}', [App\Http\Controllers\ShipmentTypeController::class, 'destroy'])->name('shipment_types.destroy');


    Route::get('/admin/paymentmethod', [App\Http\Controllers\PaymentMethodController::class, 'index_admin'])->name('paymentmethod.index_admin');
    Route::get('/paymethods/create', [App\Http\Controllers\PaymentMethodController::class, 'create'])->name('paymethods.create');
    Route::post('/paymethods/store', [App\Http\Controllers\PaymentMethodController::class, 'store'])->name('paymethods.store');
    Route::get('/paymethods/{paymentMethod}/edit', [App\Http\Controllers\PaymentMethodController::class, 'edit'])->name('paymethods.edit');
    Route::put('/paymethods/{paymentMethod}', [App\Http\Controllers\PaymentMethodController::class, 'update'])->name('paymethods.update');
    Route::delete('/paymethods/{paymentMethod}', [App\Http\Controllers\PaymentMethodController::class, 'destroy'])->name('paymethods.destroy');

    Route::get('/databanktransfer', [App\Http\Controllers\DataBankTransferController::class, 'index'])->name('databanktransfer.index');
    Route::get('/databanktransfer/create', [App\Http\Controllers\DataBankTransferController::class, 'create'])->name('databanktransfer.create');
    Route::post('/databanktransfer/store', [App\Http\Controllers\DataBankTransferController::class, 'store'])->name('databanktransfer.store');
    Route::delete('/databanktransfer/{id}', [App\Http\Controllers\DataBankTransferController::class, 'destroy'])->name('databanktransfer.destroy');

    Route::group(['middleware' => ['permission:mantenedor webpay']], function () {
        Route::get('/webpay', [WebpayCredentialController::class, 'index'])->name('webpaycredentials.index');
        Route::get('/webpay/create', [WebpayCredentialController::class, 'create'])->name('webpaycredentials.create');
        Route::post('/webpay/store', [WebpayCredentialController::class, 'store'])->name('webpaycredentials.store');
        Route::get('/webpay/{id}/edit', [WebpayCredentialController::class, 'edit'])->name('webpaycredentials.edit');
        Route::patch('/webpay/{id}/update', [WebpayCredentialController::class, 'update'])->name('webpaycredentials.update');
        Route::delete('/webpay/{id}', [WebpayCredentialController::class, 'destroy'])->name('webpaycredentials.destroy');

    });

    Route::get('/calendar', [EventController::class, 'index'])->name('calendar');
    Route::post('/events', [EventController::class, 'store'])->name('event.store');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('event.destroy');

    Route::get('/page', function () {
        return view('page');
    })->name('page');




    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/store/{id}', [OrderController::class, 'store'])->name('orders-store');
    Route::post('/orders/{id}/edit', [OrderController::class, 'update'])->name('orders.edit');
    Route::get('/orders/{id}/details', [OrderController::class, 'getOrderDetails']);


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin_home');


    Route::group(['middleware' => ['permission:mantenedor productos']], function () {
        Route::get('/productos', [ProductController::class, 'index'])->name('productos');
        Route::get('/productos/create', [ProductController::class, 'create'])->name('productos-create');
        Route::post('/productos/store', [ProductController::class, 'store'])->name('productos-store');
        Route::post('/productos/store', [ProductController::class, 'store_static'])->name('productos-store-static');
        Route::get('/productos/{id}/edit', [ProductController::class, 'edit'])->name('productos-edit');
        Route::patch('/productos/{id}/update', [ProductController::class, 'update'])->name('productos-update');
        Route::delete('/productos/{id}', [ProductController::class, 'destroy'])->name('productos-destroy');
    });


    Route::group(['middleware' => ['permission:mantenedor ordenes']], function () {
        Route::get('/orden-compra', [PurcharseOrderController::class, 'index'])->name('orden-compra');
        Route::get('/orden-compra/create', [PurcharseOrderController::class, 'create'])->name('orden-compra-create');
        Route::post('/orden-compra/store', [PurcharseOrderController::class, 'store'])->name('orden-compra-store');
        Route::get('/orden-compra/{id}/edit', [PurcharseOrderController::class, 'edit'])->name('orden-compra-edit');
        Route::delete('/orden-compra/{id}/destroy', [PurcharseOrderController::class, 'destroy'])->name('orden-compra-destroy');

        Route::get('/orden-compra/{id}/pdf', [PurcharseOrderController::class, 'generate_pdf'])->name('orden-compra-pdf');

        Route::get('orden-compra-product-add/{id}/edit', [PurcharseOrderProductController::class, 'show'])->name('orden-compra-product-add-edit');

        Route::post('/orden-compra-product/store', [PurcharseOrderProductController::class, 'store'])->name('orden-compra-product-store');
        Route::get('/orden-compra-product/{id}/edit', [PurcharseOrderProductController::class, 'edit'])->name('orden-compra-product-edit');
        Route::patch('/orden-compra-product/{id}/update', [PurcharseOrderProductController::class, 'update'])->name('orden-compra-product-update');
        Route::get('/orden-compra-product/{id}/destroy', [PurcharseOrderProductController::class, 'destroy'])->name('orden-compra-product-destroy');

    });

    Route::group(['middleware' => ['permission:mantenedor categorias']], function () {
        Route::get('/categorias', [CategoryController::class, 'index'])->name('categorias');
        Route::get('/categorias/create', [CategoryController::class, 'create'])->name('categorias-create');
        Route::post('/categorias/store', [CategoryController::class, 'store'])->name('categorias-store');
        Route::get('/categorias/{id}/edit', [CategoryController::class, 'edit'])->name('categorias-edit');
        Route::patch('/categorias/{id}/update', [CategoryController::class, 'update'])->name('categorias-update');
        Route::delete('/categorias/{id}', [CategoryController::class, 'destroy'])->name('categorias-destroy');
    });

    Route::group(['middleware' => ['permission:mantenedor marcas']], function () {

        Route::get('/marcas', [BrandController::class, 'index'])->name('marcas');
        Route::get('/marcas/create', [BrandController::class, 'create'])->name('marcas-create');
        Route::post('/marcas/store', [BrandController::class, 'store'])->name('marcas-store');
        Route::get('/marcas/{id}/edit', [BrandController::class, 'edit'])->name('marcas-edit');
        Route::patch('/marcas/{id}/update', [BrandController::class, 'update'])->name('marcas-update');
        Route::delete('/marcas/{id}', [BrandController::class, 'destroy'])->name('marcas-destroy');
    });

    Route::group(['middleware' => ['permission:mantenedor roles']], function () {
        Route::get('/roles', [App\Http\Controllers\RolesController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [App\Http\Controllers\RolesController::class, 'create'])->name('roles.create');
        Route::post('/roles/store', [App\Http\Controllers\RolesController::class, 'store'])->name('roles.store');
        Route::get('/roles/{id}/edit', [App\Http\Controllers\RolesController::class, 'edit'])->name('roles.edit');
        Route::patch('/roles/{id}', [App\Http\Controllers\RolesController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{id}', [App\Http\Controllers\RolesController::class, 'destroy'])->name('roles.destroy');
    });

    Route::group(['middleware' => ['permission:mantenedor permisos']], function () {
        Route::get('/permissions', [App\Http\Controllers\PermissionsController::class, 'index'])->name('permissions.index');
        Route::get('/permissions/create', [App\Http\Controllers\PermissionsController::class, 'create'])->name('permissions.create');
        Route::post('/permissions/store', [App\Http\Controllers\PermissionsController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/{id}/edit', [App\Http\Controllers\PermissionsController::class, 'edit'])->name('permissions.edit');
        Route::patch('/permissions/{id}', [App\Http\Controllers\PermissionsController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{id}', [App\Http\Controllers\PermissionsController::class, 'destroy'])->name('permissions.destroy');
    });
    Route::group(['middleware' => ['permission:mantenedor secciones landing']], function () {
        Route::get('/secciones', [App\Http\Controllers\SectionController::class, 'index'])->name('section.index');
        Route::get('/secciones/create', [App\Http\Controllers\SectionController::class, 'create'])->name('section.create');
        Route::post('/secciones/store', [App\Http\Controllers\SectionController::class, 'store'])->name('section.store');
        Route::get('/secciones/{id}/edit', [App\Http\Controllers\SectionController::class, 'edit'])->name('section.edit');
        Route::patch('/secciones', [App\Http\Controllers\SectionController::class, 'update'])->name('section.update');
        Route::delete('/secciones/{id}', [App\Http\Controllers\SectionController::class, 'destroy'])->name('section.destroy');
    });



    Route::get('/shipments', [App\Http\Controllers\ShipmentController::class, 'index'])->name('shipments.index');
    Route::get('/shipments/{id}/edit', [App\Http\Controllers\ShipmentController::class, 'status_edit'])->name('shipments.status_edit');
    Route::get('/shipments/{id}/{last}/update', [App\Http\Controllers\ShipmentController::class, 'status_update'])->name('shipments.status_update');
    Route::delete('/shipments/{id}', [App\Http\Controllers\ShipmentController::class, 'destroy'])->name('shipments.destroy');
    Route::get('/shipments/{id}/{last}', [App\Http\Controllers\ShipmentController::class, 'status_cancel'])->name('shipment_cancel');

    Route::group(['middleware' => ['permission:mantenedor reviews']], function () {
        Route::get('/reviews', [App\Http\Controllers\ReviewsController::class, 'index'])->name('reviews.index');
        Route::delete('/reviews/{id}', [App\Http\Controllers\ReviewsController::class, 'destroy'])->name('reviews.destroy');

    });

    Route::group(['middleware' => ['permission:mantenedor acciones']], function () {
        Route::get('/actions', [App\Http\Controllers\ActionController::class, 'index'])->name('actions.index');
        Route::delete('/actions/{id}', [App\Http\Controllers\ActionController::class, 'destroy'])->name('actions.destroy');

    });

    Route::group(['middleware' => ['permission:mantenedor productos deseados']],function(){
        Route::get('/productos_deseados',[ProductDesiredController::class,'index'])->name('product_desired');
        Route::get('/productos_deseados/pdf/{id}',[ProductDesiredController::class,'generate_pdf'])->name('product_desired_pdf');
    });

    Route::group(['middleware' => ['permission:mantenedor punto de venta']], function () {
        Route::get('/punto-venta', [PointOfSaleController::class, 'index'])->name('point_of_sale');
        Route::post('/punto-venta-store',[PointOfSaleController::class,'store'])->name('point_of_sale-store');
        Route::get('/punto-venta-update/{id}', [PointOfSaleController::class, 'update'])->name('point_of_sale-update');
        Route::get('/punto-venta/addProduct/{id}',[PointOfSaleController::class,'addProduct'])->name('point_of_sale-addProduct');
        Route::get('/punto-venta/dropProduct-/{id}', [PointOfSaleController::class, 'disminuyeCantidad'])->name('point_of_sale-disminuyeCantidad');
        Route::get('/punto-venta/dropProduct/{id}', [PointOfSaleController::class, 'dropProduct'])->name('point_of_sale-dropProduct');
        Route::get('/punto-venta/createOrder', [PointOfSaleController::class, 'createOrder'])->name('point_of_sale-createOrder');
    });


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin_home');
});




Route::group(['middleware' => ['permission:vista analista'], 'prefix' => 'analista'], function () {
    //insertar rutas de analista aqui


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('analista_home');
});

Auth::routes();
//rutas cliente
Route::get('/productos_deseados/{user}', [ProductDesiredController::class, 'show'])->name('products-desired');
Route::post('/like_producto', [ProductDesiredController::class, 'store_and_delete'])->name('like-product');

Route::get('/profile_landing', [App\Http\Controllers\ProfileLandingController::class, 'index'])->name('profile_landing');
Route::post('/profile_landing_edit/{id}', [App\Http\Controllers\ProfileLandingController::class, 'update'])->name('profile_landing_edit');
Route::get('/profile_landing/{id}/pdf', [OrderController::class, 'genera_pdf'])->name('profile_landing_order_pdf');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'showCart'])->name('showcart');
Route::post('/removeitem/{rowId}', [App\Http\Controllers\CartController::class, 'removeitem'])->name('removeitem');
Route::get('/increment/{id}', [App\Http\Controllers\CartController::class, 'incrementitem'])->name('incrementitem');
Route::get('/decrement/{id}', [App\Http\Controllers\CartController::class, 'decrementitem'])->name('decrementitem');
Route::post('/destroycart', [App\Http\Controllers\CartController::class, 'destroycart'])->name('destroycart');


Route::get('/paymentmethod', [App\Http\Controllers\PaymentMethodController::class, 'index'])->name('paymentmethod.index');
Route::post('/paymethods/store_landing', [App\Http\Controllers\PaymentMethodController::class, 'store_landing'])->name('paymethods.store_landing');


Route::post('/change_password_landing', [App\Http\Controllers\ChangePasswordController::class, 'changePasswordLanding'])->name('change_password_landing');

Route::post('/change_password_argon', [App\Http\Controllers\ChangePasswordController::class, 'changePasswordArgon'])->name('change_password_argon');




Route::post('/cart/generateOrder', [CartController::class, 'generateOrder'])->name('cart.generateOrder');


Route::POST('/paymentmethod', [App\Http\Controllers\ShipmentController::class, 'create'])->name('shipments.create');
Route::get('/shippingmethod', [App\Http\Controllers\ShippingMethodsController::class, 'index'])->name('shippingview.index');




Route::Post('/resume_checkout', [ResumeController::class, 'showResume'])->name('resume_checkout');


Route::post('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::post('/additem', [App\Http\Controllers\CartController::class, 'additem'])->name('additem');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/{productId}/{userId}', [App\Http\Controllers\ReviewsController::class, 'store'])->name('reviews.store');

Route::get('/knowmeview',[App\Http\Controllers\HomeLanding::class, 'index'], [App\Http\Controllers\KnowMeController::class, 'index'])->name('knowmeview.index');
Route::get('/termsconditionsview', [App\Http\Controllers\TermsConditionsController::class, 'index'])->name('termsconditionsview.index');



Route::post('/confirmationcart/{orderId}', [App\Http\Controllers\CartController::class, 'confirmOrder'])->name('confirmationcart');
Route::post('/checkout_transfer', [CheckOutController::class, 'CheckOutTransfer'])->name('checkout_transfer');

Route::post('/checkout_transbank', [TransbankController::class, 'checkOutTransBank'])->name('checkout_transbank');
Route::get('/confirmationTransbank/{orderId}', [TransbankController::class, 'confirmOrderTransbank'])->name('confirmationTransbank');
Route::get('/webpay/error', [TransbankController::class, 'handleWebpayError'])->name('webpay.error');
