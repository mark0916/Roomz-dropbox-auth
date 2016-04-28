# Roomz-dropbox-client (work in progress)
dropbox-php-sdk implementation in laravel

composer (check for specific tag if needed)

```
"repositories": [
{
    "type": "vcs",
    "url": "https://github.com/markdingemanse/roomz-dropbox-client"
}
],
"require": {
    "php": ">=5.5.9",
    "laravel/framework": "5.2.*",
    "mark0916/roomz-dropbox-client": "dev-master"
},
```

add these entries to your env file

```
ROOMZ_DROPBOX_KEY=

ROOMZ_DROPBOX_SECRET=

ROOMZ_DROPBOX_NAME=

ROOMZ_DROPBOX_CALLBACK=[http://localhost:8000/callback](http://localhost:8000/callback)
```

add this line to your app.php

```
Roomz\Dropbox\Providers\RoomzDropboxServiceProvider::class,
```

example routes for testing purposes

```
Route::get('/', 'Controller@index');
Route::get('/callback', 'Controller@callback');
```

example controller for testing purposes

```
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Roomz\Dropbox\Auth\AuthRepositoryInterface;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $dropbox;
    private $dummyUser;

    public function __construct(
        AuthRepositoryInterface $auth,
        User $user
    ) {
        $this->dropbox   = $auth;
        $this->dummyUser = $user->where('name','roomz')->first();
    }

    public function index(){
        $this->dropbox->boot($this->dummyUser);
        return json_encode($this->dropbox->getClientDetails($this->dummyUser));
    }

    public function callback(){
        return json_encode($this->dropbox->callback($this->dummyUser));
    }
}
```

this package uses the default user model with a extra field called 'dropboxToken' with the command php artisan migrate you can get the basic user table.
