
# laravolt/epicentrum

## Installation
`composer require laravolt/epicentrum`

## Configuration

Publish configuration file using command:

```bash
php artisan vendor:publish --tag=migrations --provider='Laravolt\Epicentrum\ServiceProvider
```

And there will be file `config/laravolt/epicentrum.php` and preconfigured config inside it:

```php
<?php
return [
	// setting route
	'route' => [
		'enable' => true,
		'middleware' => ['web', 'auth'],
		'prefix' => 'epicentrum',
	],
	// base layout to extended
	'view' => [
		'layout' => 'ui::layouts.app',
	],
	// setting menu visibility to laravolt/ui
	'menu' => [
		'enable' => true,
	],
	// allow user to has multiple role
	'role' => [
		'multiple' => true,
		'editable' => true,
	],
	// list repository that you can modify
	'repository' => [
		// modify crud of user management
		'user' => \Laravolt\Epicentrum\Repositories\EloquentRepository::class,
		// set default time zone that used
		'timezone' => \Laravolt\Support\Repositories\TimezoneRepository::class,
		// change the criteria on searching feature
		'criteria' => [
			\Prettus\Repository\Criteria\RequestCriteria::class,
		],
		// specify column that can searchable
		'searchable' => ['name', 'email', 'status'],
	],
	'requests' => [
		// modify validation of store data crud
		'account' => [
			'store' => \Laravolt\Epicentrum\Http\Requests\Account\Store::class,
			'update' => \Laravolt\Epicentrum\Http\Requests\Account\Update::class,
			'delete' => \Laravolt\Epicentrum\Http\Requests\Account\Delete::class,
		],
	],
	// change user status available
	'user_available_status' => [
		'PENDING' => 'PENDING',
		'ACTIVE' => 'ACTIVE',
	],
	// specify the model of role
	'models' => [
		'role' => \Laravolt\Acl\Models\Role::class,
	],
	// Whether to auto load migrations or not.
    	// If set to false, then you must publish the migration files first before running the migrate command
    	'migrations' => true,
	// modify table view on user list page
    	'table_view' => \Laravolt\Epicentrum\Table\UserTable::class
];
```
## Custom View File

You can publish views file using:

```bash
php artisan vendor:publish --tag=views --provider='Laravolt\Epicentrum\ServiceProvider'
```

And then, you can modify the view located in `resources/views/vendor/epicentrum/*`.

The structure of epicentrum view file :

```
|-- account
|	|-- edit.blade.php
|-- emails
|	|-- account_information.blade.php
|-- my
|	|-- password
|		|-- edit.blade.php
|-- password
|	|-- edit.blade.php
|-- role
|	|-- edit.blade.php
|-- roles
|	|-- create.blade.php
|	|-- edit.blade.php
|	|-- index.blade.php
|-- create.blade.php
|-- edit.blade.php
|-- index.blade.php
```
## FAQ
* **How to override the controller ?**
Override the controller is not best practice. If you want to pass data into view, you need to use [Laravel Blade Service Injection](https://laravel.com/docs/5.8/blade#service-injection).
If you need to change the **redirect**, you must override the view and make custom route and controller by yourself. And then extends that controller to Epicentrum Controller.

