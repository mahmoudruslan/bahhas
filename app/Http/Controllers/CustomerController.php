<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Customer;
use App\Traits\HtmlTrait;
use Illuminate\Http\Request;
use App\DataTables\CustomerDataTable;
use App\Http\Requests\CustomerRequest;
use App\Notifications\AccountStatusNotification;
use App\Traits\Files;

class CustomerController extends Controller
{
    use HtmlTrait, Files;

    public function index(CustomerDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.customers.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $customers = Customer::get();
        return view('admin.customers.create', compact('customers'));
    }

    public function store(CustomerRequest $request)
    {
        try {
            $data = $request->validated();
                $path = 'images/customers/';
                $file_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $file_name;
            Customer::create($data);
            return redirect()->route('admin.customers.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Customer $customer)
    {
        try {
            $customers = Customer::get();
        return view('admin.customers.edit', compact('customers', 'blog'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $data = $request->validated();
            $image = $request->file('image');
            if ($image) {
                $this->deleteFiles($customer->image);
                $path = 'images/customers/';
                $file_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $file_name;
            }
            $customer->update($data);
            return redirect()->route('admin.customers.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Customer $customer)
    {
        try {
            return view('admin.customers.show', compact('blog'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            $this->deleteFiles($customer->image);
            $customer->delete();
            return redirect()->route('admin.customers.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
