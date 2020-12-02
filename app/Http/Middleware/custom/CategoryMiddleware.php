<?php

namespace App\Http\Middleware\custom;

use App\Models\Category;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CategoryMiddleware
{
    private $route;


    public function __construct(Route $route)
    {
        $this->route=$route;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id=$this->route->parameters['id'];

        $category=Category::find($id);

        if(!$category){
            $request->session()->flash('error_category','CATEGORY NOT FOUND');
            return  redirect()->route('category.index');
        }


        return $next($request);
    }
}
