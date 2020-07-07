# Full-Stack-Vue.js-2-and-Laravel-7

## Description

This repository is a Software of Development with Laravel,Vuejs,MySQL,etc

## Installation

Using Laravel 7 and Vue.js 2 Server preferably.

## DataBase

Using MySQL preferably.
Create a MySQL database and configure the .env file.

## Apps

Using Postman, Insomnia,etc

## Usage

```html
$ git clone https://github.com/DanielArturoAlejoAlvarez/Full-Stack-Vue.js-2-and-Laravel-7[NAME APP]

$ composer install

$ copy .env.example .env

$ php artisan key:generate

$ php artisan migrate:refresh --seed

$ php artisan serve

$ npm install (Frontend)

$ npm run dev

```

Follow the following steps and you're good to go! Important:

![alt text](https://raw.githubusercontent.com/onecentlin/laravel5-snippets-vscode/master/images/screenshot.gif)

## Coding

### Requests

```php
...
class Post extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'   =>    'required',
            'body'    =>    'required'
        ];
    }
}
...
```

### Controllers

```php
...
class PostController extends Controller
{
    private $post;

    /*
    ** 100 info
    ** 200 response successfuly
    ** 300 redirect
    ** 400 error client
    ** 500 error server
    */


    public function __construct(Post $post)
    {
      $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
          new PostCollection(
            $this->post->orderBy('id','desc')->get()
          )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequests $request)
    {
      $post = $this->post->create($request->all());

      return response()->json(new PostResources($post), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return response()->json(new PostResources($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return response()->json(new PostResources($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
...
```

### Models

```php
...
class Post extends Model
{
  protected $fillable = ['title', 'body'];
}
...
```

### Resources

```php
...
class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $opt = Str::length($this->body) > 128 ? '...' : '';
      return [
        'id'        =>  $this->id,
        'post_name' =>  Str::upper($this->title),
        'post_body' =>  Str::substr($this->body,0,128) . $opt,
        'published' =>  $this->created_at->diffForHumans(),
        'created_at'=>  $this->created_at->format('d-m-Y'),
        'updated_at'=>  $this->updated_at->format('d-m-Y')
      ];
        //return parent::toArray($request);
    }
}
...
```

### Middlewares

```php
...
class apiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      try {
        $user = JWTAuth::parseToken()->authenticate();
      } catch (\Exception $e) {
        if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
          return response()->json(['status'=>'Token is Invalid!']);
        }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
          return response()->json(['status'=>'Token is Expired!']);
        }else {
          return response()->json(['status'=>'Authorization Token not found!']);
        }
      }

        return $next($request);
    }
}
...
```

### Routes
```php
...
Route::post('auth/login', 'Api\AuthController@login')->name('login');

//Use of tokens in external systems...


Route::group(['middleware'=>['apiJwt']], function() {
  Route::apiResource('posts','Api\PostController')
        ->names([
          'index'   =>    'api.posts.index',
          'show'    =>    'api.posts.show',
          'store'   =>    'api.posts.store',
          'update'  =>    'api.posts.update',
          'destroy' =>    'api.posts.destroy'
        ]);
});

Route::get('posts','Api\PostController@index');
...
```

### Factory
```php
...
$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' =>  $faker->sentence,
        'body'  =>  $faker->text
    ];
});
...
```

### Seeders
```php
...
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
          'name'      =>  'admin',
          'email'     =>  'admin@gmail.com',
          'password'  =>  bcrypt('password')
        ]);

        factory(Post::class,18)->create();
    }
}
...
```

### Views
```js
...
import axios from 'axios';

export default {
    data() {
      return {
        posts: null
      }
    },
    mounted() {
      this.getPosts();
    },
    methods: {
      getPosts: function() {
        axios.get('api/posts')
          .then(response => {
            this.posts = response.data
          });
      }
    }
}
...
```


## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/DanielArturoAlejoAlvarez/Full-Stack-Vue.js-2-and-Laravel-7. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.

## License

The gem is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).

```

```
