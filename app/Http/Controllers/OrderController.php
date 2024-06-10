<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Exports\ExportOrder;
use App\Http\Requests\OrderRequest;
use App\Imports\ImportOrder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Order;
use App\Notifications\StatusOrderNotification;
use App\Traits\Files;
use App\Traits\HtmlTrait;
use Illuminate\Http\Request;
use DataTables;

class OrderController extends Controller
{
    use HtmlTrait, Files;


    public function index(OrderDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.orders.index');
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
            // $order->customer->notify(new StatusOrderNotification($order));
            

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
    public function downloadPDF(Order $order)
    {
        return $this->downloadFile($order->attach);
    }
}
