<?php

namespace App\Providers;

use App\Models\Order;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        //management order percentage
        view()->composer('admin.dashboard', function ($view) {
        //     $order_count = count(Order::get());
        //     $data['acceptance_count'] = count(Order::where('status', 0)->get());
        //     $data['rejection_count'] = count(Order::where('status', 1)->get());
        //     $data['failure_count'] = count(Order::where('status', 2)->get());
        //     $data['pending_count'] = count(Order::where('status', 3)->get());
        //     $data['delivery_count'] = count(Order::where('status', 4)->get());
        //     $data['successfully_delivered_count'] = count(Order::where('status', 5)->get());
        //     $failure = $data['failure_count'] / $order_count;
        //     $rejection = $data['rejection_count'] / $order_count;
        //     $acceptance = $data['acceptance_count'] / $order_count;
        //     $pending = $data['pending_count'] / $order_count;
        //     $delivery = $data['delivery_count'] / $order_count;
        //     $successfully_delivered = $data['successfully_delivered_count'] / $order_count;
        //     $data['failure_percentage'] = round((float)$failure * 100) . '%';
        //     $data['rejection_percentage'] = round((float)$rejection * 100) . '%';
        //     $data['percentage_of_acceptance'] = round((float)$acceptance * 100) . '%';
        //     $data['percentage_of_pending'] = round((float)$pending * 100) . '%';
        //     $data['percentage_of_delivery'] = round((float)$delivery * 100) . '%';
        //     $data['percentage_of_successfully_delivered'] = round((float)$successfully_delivered * 100) . '%';
        //     $data['order'] = Order::all();
        //     $view->with([
        //         'data' =>  $data,
        //     ]);
        // });
        // $data = [];
        $data['acceptance_count'] = '';
        $data['rejection_count'] = '';
        $data['failure_count'] = '';
        $data['pending_count'] = '';
        $data['delivery_count'] = '';
        $data['successfully_delivered_count'] = '';
        $data['failure_percentage'] = '';
        $data['rejection_percentage'] = '';
        $data['percentage_of_acceptance'] = '';
        $data['percentage_of_pending'] = '';
        $data['percentage_of_delivery'] = '';
        $data['percentage_of_successfully_delivered'] = '';
        $data['order'] = '';

        $view->with([
                    'data' =>  $data,
                ]);
            });
    }
}
