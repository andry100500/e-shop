<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\Images\ImageLinkManager;
use App\Models\Basket;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use App\Http\Resources\BasketResource;
use Illuminate\Support\Facades\Lang;


class BasketController extends Controller
{
    public function show()
    {
        $basketRows = Basket::where('app_user_id', $_COOKIE['app_user_id'])->get();


        if ($basketRows) {
            $productIds = [];
            $productCounts = [];
            $total = 0;
            foreach ($basketRows as $basketRow) {
                $productIds[] = $basketRow->product_id;
                $productCounts[$basketRow->product_id] = $basketRow->count;

            }

            $products = Product::with(['productDescription'])->whereIn('id', $productIds)->get();

            foreach ($products as $product){
                $total += $product->price * $productCounts[$product->id];
                $product->image = ImageLinkManager::getImageUrl($product->image, 'small');
            }

            $deliveryMethods = DeliveryMethod::with('deliveryMethodDescription')->get();
            $paymentMethods = PaymentMethod::with('paymentMethodDescription')->get();
        }

        $breadcrumbs[] = [
            'ancor' => Lang::get('basket.h1')];

        return view('front.basket.basket-page-layout', compact('products',
            'productCounts', 'total', 'deliveryMethods', 'paymentMethods', 'breadcrumbs'));
    }

    /**
     * Маршрут сохранения заказа
     */

    public function makeOrder(OrderStoreRequest $request)
    {
        $order = new Order();
        $order->number = Order::max('number') + 1;
        $order->phone = $request->phone;
        $order->name = $request->name;
        $order->second_name = $request->second_name;
        $order->city = $request->city;
        $order->delivery_method_id = $request->delivery_method_id;
        $order->payment_method_id = $request->payment_method_id;
        $order->summ = $request->summ;
        $order->comment = $request->comment;
        $order->save();

        $products = $request->products;

        foreach ($products as $product_id => $count) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product_id;
            $orderProduct->count = $count;
            $orderProduct->price = Product::where('id', $product_id)->select('price')->first()->price;
            $orderProduct->save();
            $order->summ += $orderProduct->price;
        }
        $order->save();


        $basketRows = Basket::where('app_user_id', $_COOKIE['app_user_id'])->get();


        foreach ($basketRows as $basketRow) {
            $basketRow->delete();
        }

        return redirect()->route('order-done');
    }

}
