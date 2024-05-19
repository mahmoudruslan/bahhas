<?php

namespace App\Http\Controllers;

use App\Exports\ExportOrder;
use App\Http\Requests\OrderRequest;
use App\Imports\ImportOrder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Order;
use App\Notifications\StatusOrderNotification;
use App\Traits\HtmlTrait;
use Illuminate\Http\Request;
use DataTables;

class OrderController extends Controller
{
    use HtmlTrait;


    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $order = Order::orderBy('id', 'DESC')->get();
                return DataTables::of($order)
                    ->addIndexColumn()
                    ->addColumn('username', function ($row) {
                        $btn = $row->customer->name;
                        return $btn;
                    })
                    ->addColumn('phone', function ($row) {
                        $btn = $row->customer->phone;
                        return $btn;
                    })
                    ->addColumn('address', function ($row) {
                        $btn = $row->customer->address;
                        return $btn;
                    })
                    ->addColumn('action', function ($row) {
                        $btn = $this->h_show(route('admin.orders.show', $row->id));
                        $btn = $btn . ' ' . $this->h_edit(route('admin.orders.edit', $row->id));
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.orders.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            return view('admin.orders.show', compact(['order']));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $order = Order::findOrFail($id);
            return view('admin.orders.edit', compact('order'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(OrderRequest $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            
            $order->update([
                'status' => $request->status
            ]);
            $order->customer->notify(new StatusOrderNotification($order));
            

            return redirect()->back()->with(['success' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return redirect()->back()->with(['success' => 'Deleted Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new ExportOrder, 'orders.xlsx');
    }

    public function exportCSV(Request $request)
    {
        return Excel::download(new ExportOrder, 'orders.csv');
    }
}
