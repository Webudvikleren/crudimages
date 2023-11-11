

## Requirements
The package views uses Bootstrap 5. 

The package assumes you have a layout-file `layout.app` that can be extended. In your layout-file you also have the following sections: 

* content
  * The main content of the webpage.
* meta_title
  * The title of your webpage. 

## Installation

> composer require philipsorensen/crudpages

Add the following in your `config/app.php` under providers. 

```
Webudvikleren\CrudImages\Providers\CrudImagesProvider::class
```

## Usage

Add something like this to your `routes/web.php`:
```
<?php
use Webudvikleren\CrudImages\Controllers\CrudImagesController;

Route::controller(CrudImagesController::class)->middleware('can:image crud')->name('admin.crudimages.')->prefix('images')->group(function () {
	Route::get('', 'index')->name('index');
	Route::get('create', 'create')->name('create');
	Route::post('create', 'store');
	Route::get('{id}/delete', 'delete')->name('delete');
	Route::get('{id}/edit', 'edit')->name('edit');
	Route::post('{id}/edit', 'update');
});
```