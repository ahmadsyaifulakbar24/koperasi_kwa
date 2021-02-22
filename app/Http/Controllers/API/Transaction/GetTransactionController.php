<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Resources\Transaction\UserTransactionMonthCollection;
use App\Http\Resources\Transaction\UserTransactionMonthResource;
use App\Models\SubTransaction;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VwUserTransaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Trait_;
use stdClass;

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

    public function simpanan_perbulan(Request $request)
    {
        $this->validate($request, [
            'month' => ['required', 'numeric', 'max:12'],
            'year' => ['required', 'numeric'],
            'page' => ['nullable', 'numeric']
        ]);
        $users = User::where('user_level_id', '!=' , 1)->paginate(10);
        foreach($users as $user) {
            $user_id = $user->id;
            $simpanan_sukarela = VwUserTransaction::select(DB::raw('sum(besaran) as total'))->where([['type_transaction', 'simpanan'], ['user_id', $user_id]])->whereNotNull('transaction_approved_date')->whereMonth('transaction_created_at', $request->month)->whereYear('transaction_created_at', $request->year)->where('type_sub_transaction', 'simpanan_sukarela')->first();
            $simpanan_wajib = VwUserTransaction::select(DB::raw('sum(besaran) as total'))->where([['type_transaction', 'simpanan'], ['user_id', $user_id]])->whereNotNull('transaction_approved_date')->whereMonth('transaction_created_at', $request->month)->whereYear('transaction_created_at', $request->year)->where('type_sub_transaction', 'simpanan_wajib')->first();
            $items[] = [
                'name' => $user->name,
                'simpanan_sukarela' => ($simpanan_sukarela['total']) ?? 0 ,
                'simpanan_wajib' => ($simpanan_wajib['total']) ?? 0,
            ];
        }
        
        $total = User::where('user_level_id', '!=' , 1)->count();
        $current_page = $request->page ?? 0;
        $per_page = 10;
        $from = ($current_page - 1) * $per_page + 1;
        $last_page = ceil($total/$per_page);
        $to = $from + $per_page;
        $next_page = $current_page + 1;
        $prev_page = $current_page - 1;
        $next_page_url = ($next_page >= $last_page) ? NULL : url()->current().'?page=' . $next_page;
        $prev_page_url = ($prev_page < 1) ? NULL : url()->current().'?page=' . $prev_page;
        $data = [
            'data' => $items ?? NULL,
            'current_page' => $current_page,
            'from' => !empty($items) ? $from : NULL,
            'per_page' => $per_page,
            'last_page' => $last_page,
            'total' => $total,
            'to' => !empty($items) ? $to : NULL,
            'next_page' => $next_page,
            'prev_page' => $prev_page,
            'next_page_url' => $next_page_url,
            'prev_page_url' => $prev_page_url,
        ];
        return response()->json($data);
    }
}
