<?php
Route::group(['middleware' => 'auth:admin','namespace'=>'admin'], function()
{

//porducts module
	Route::get('/productList','ProductController@productList')->middleware('permission:product list')->name('admin.productList');
	Route::get('/producAdd','ProductController@productAddForm')->middleware('permission:add product')->name('admin.productAdd');
	Route::post('/product-save','ProductController@productSave')->middleware('permission:add product')->name('admin.product.productSave');
	Route::get('/printBarcode','ProductController@printBarcode')->middleware('permission:print barcode')->name('admin.printBarcode');
	Route::post('/generate-barcode','ProductController@generateBarcode')->middleware('permission:print barcode')->name('admin.product.generateBarcode');
	Route::get('/quantityAdjustment','ProductController@quantityAdjustment')->name('admin.quantityAdjustment');
	Route::post('/producr-details','ProductController@productDetails')->name('admin.product.productDetails');
	Route::get('/product-info/{id}','ProductController@productInfo')->name('admin.product.productInfo');
	Route::post('edit-product','ProductController@productEdit')->middleware('permission:edit product')->name('admin.product.productEdit');
	Route::post('/update-product-information','ProductController@updateProduct')->middleware('permission:edit product')->name('admin.product.updateProduct');
	Route::post('search-products','ProductController@searchProduct')->name('admin.product.searchProducts');
	Route::post('/delete-product','ProductController@deleteProduct')->middleware('permission:delete product')->name('admin.product.deleteProduct');
	//add low stcok product to purchase
	Route::get('/add-lowStock-to-purchase/{id}','ProductController@addStock')->name('admin.stock.lowStock.addStock');
//stock
	Route::get('/low-stock-products','StockController@lowStockProduct')->name('admin.stock.lowStockProduct');


//export product
	Route::get('export-product-excel','ProductController@ProductExcel')->name('admin.product.export.excel');
});