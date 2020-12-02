<?php

namespace App\Http\Middleware\custom;

use App\Models\Discount;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class DiscountMiddleware
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

        $discount=Discount::find($id);

        if(!$discount){
            $request->session()->flash('error_discount','DISCOUNT NOT FOUND');
            return  redirect()->route('discount.index');
        }

        return $next($request);
    }
}
