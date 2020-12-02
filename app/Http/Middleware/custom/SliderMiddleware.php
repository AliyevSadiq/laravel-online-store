<?php

namespace App\Http\Middleware\custom;

use App\Models\Slider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SliderMiddleware
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

        $slider=Slider::find($id);
        if(!$slider){
           $request->session()->flash('error_slider','SLIDER NOT FOUND');
           return  redirect()->route('slider.index');
        }

        return $next($request);
    }
}
