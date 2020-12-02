<?php

namespace App\Http\Middleware\custom;


use App\Models\Tag;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class TagMiddleware
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

        $category=Tag::find($id);

        if(!$category){
            $request->session()->flash('error_tag','TAG NOT FOUND');
            return  redirect()->route('tag.index');
        }
        return $next($request);
    }
}
