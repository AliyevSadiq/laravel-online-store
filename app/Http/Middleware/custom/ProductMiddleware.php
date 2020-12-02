<?php

namespace App\Http\Middleware\custom;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ProductMiddleware
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
        $product=Product::find($id);

        if(!$product){
            $request->session()->flash('error_product','PRODUCT NOT FOUND');
            return redirect()->route('product.index');
        }


        return $next($request);
    }
}
