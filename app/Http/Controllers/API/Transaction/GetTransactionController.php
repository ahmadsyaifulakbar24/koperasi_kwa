<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PhpParser\Builder\Trait_;

class GetTransactionController extends Controller
{
    public function filter(Request $request, $user_id = null)
    {
        $this->validate($request, [
            'type' => ['nullable', 'in:simpanan,pinjaman'],
            'year' => ['nullable', 'numeric', 'digits:4'],
            'month' => ['nullable', 'numeric', 'max:12'],
            'day' => ['nullable', 'numeric', 'max:31'],
            'approved' => ['nullable', 'in:true,false'],
        ]);
        $type = $request->type;
        $year = $request->year;
        $month = $request->month;
        $day = $request->day;
        $approved = $request->approved;

        !empty($user_id) ? $trasactionQuery = Transaction::where('user_id', $user_id) : $trasactionQuery = new Transaction;
        if ($type && $year && $month && $day && $approved) {
            if($approved == 'true') {
                $trasaction = $trasactionQuery->where('type', $type)
                                            ->whereYear('created_at', $year)
                                            ->whereMonth('created_at', $month)
                                            ->whereDay('created_at', $day)
                                            ->whereNotNull('approved_date')
                                            ->orderBy('id', 'desc')->paginate(15);
            } else {
                $trasaction = $trasactionQuery->where('type', $type)
                                            ->whereYear('created_at', $year)
                                            ->whereMonth('created_at', $month)
                                            ->whereDay('created_at', $day)
                                            ->whereNull('approved_date')
                                            ->orderBy('id', 'desc')->paginate(15);
            }
        } else if ($type && $year && $month && $day) {
            $trasaction = $trasactionQuery->where('type', $type)
                                        ->whereYear('created_at', $year)
                                        ->whereMonth('created_at', $month)
                                        ->whereDay('created_at', $day)
                                        ->orderBy('id', 'desc')->paginate(15);
        } else if ($type && $year && $month) {
            $trasaction = $trasactionQuery->where('type', $type)
                                        ->whereYear('created_at', $year)
                                        ->whereMonth('created_at', $month)
                                        ->orderBy('id', 'desc')->paginate(15);
        } else if ($type && $year) {
            $trasaction = $trasactionQuery->where('type', $type)
                                        ->whereYear('created_at', $year)
                                        ->orderBy('id', 'desc')->paginate(15);
        } else if ($type) {
            $trasaction = $trasactionQuery->where('type', $type)
                                        ->orderBy('id', 'desc')->paginate(15);
        } else {
            $trasaction = $trasactionQuery->orderBy('id', 'desc')->paginate(15);
        }
        return TransactionResource::collection($trasaction);
    }

    public function byId($trasaction_id)
    {
        $trasaction = Transaction::find($trasaction_id);
        if($trasaction) {
            return new TransactionResource($trasaction);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
