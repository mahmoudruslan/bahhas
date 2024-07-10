<?php

namespace App\Http\Controllers;

use App\DataTables\TransferDataTable;
use App\Models\Transfer;
use App\Traits\Files;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    use Files;
    public function index(TransferDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.transfers.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {
        try {
            $transfer = Transfer::find($id);
            $this->deleteFiles($transfer->receipt);
            $transfer->delete();
            return redirect()->route('admin.transfers.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
