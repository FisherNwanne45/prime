<?php

namespace App\Http\Controllers\Backend;

use App\Enums\TxnStatus;
use App\Enums\TxnType;
use App\Http\Controllers\Controller;
use App\Models\LevelReferral;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\NotifyTrait;
use DataTables;
use Exception;
use Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Txn;


class UserController extends Controller
{
    use NotifyTrait;

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:customer-list|customer-login|customer-mail-send|customer-basic-manage|customer-change-password|all-type-status|customer-balance-add-or-subtract|customer-create|customer-delete', [
            'only' => ['index', 'activeUser', 'disabled', 'mailSendAll', 'mailSend', 'store', 'destroy']
        ]);
        $this->middleware('permission:customer-basic-manage|customer-change-password|all-type-status|customer-balance-add-or-subtract', ['only' => ['edit']]);
        $this->middleware('permission:customer-login', ['only' => ['userLogin']]);
        $this->middleware('permission:customer-mail-send', ['only' => ['mailSendAll', 'mailSend']]);
        $this->middleware('permission:customer-basic-manage', ['only' => ['update']]);
        $this->middleware('permission:customer-change-password', ['only' => ['passwordUpdate']]);
        $this->middleware('permission:all-type-status', ['only' => ['statusUpdate']]);
        $this->middleware('permission:customer-balance-add-or-subtract', ['only' => ['balanceUpdate']]);
    }

    /**
     * @return Application|Factory|View|JsonResponse
     *
     * @throws Exception
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = User::latest();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('avatar', 'backend.user.include.__avatar')
                ->editColumn('kyc', 'backend.user.include.__kyc')
                ->editColumn('status', 'backend.user.include.__status')
                ->editColumn('balance', function ($request) {
                    return $request->balance . ' ' . setting('site_currency');
                })
                ->editColumn('email', function ($request) {
                    return safe($request->email);
                })
                ->editColumn('username', function ($request) {
                    return safe($request->username);
                })
                ->editColumn('total_profit', function ($request) {
                    return $request->total_profit . ' ' . setting('site_currency');
                })
                ->addColumn('action', 'backend.user.include.__action')
                ->rawColumns(['avatar', 'kyc', 'status', 'action'])
                ->make(true);
        }

        return view('backend.user.index');
    }

    /**
     * @return Application|Factory|View|JsonResponse
     *
     * @throws Exception
     */

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'status' => 'required|in:0,1',
            'email_verified' => 'required|in:0,1',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'email_verified_at' => $request->email_verified ? now() : null,
            'kyc' => 0, // Default KYC status
            'two_fa' => 0, // Default 2FA status
            'deposit_status' => 1, // Default deposit status
            'withdraw_status' => 1, // Default withdraw status
            'transfer_status' => 1, // Default transfer status
            'referral_id' => Str::random(10), // Generate referral ID
        ]);

        notify()->success($user->username . ' ' . __('created successfully'));
        return redirect()->route('admin.user.index');
    }



    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent deleting yourself
            if ($user->id === auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => __('You cannot delete yourself.')
                ]);
            }

            // Prevent deleting users with specific IDs (e.g., super admins)
            $protectedIds = [1]; // Add IDs of protected users
            if (in_array($user->id, $protectedIds)) {
                return response()->json([
                    'success' => false,
                    'message' => __('You cannot delete this protected user.')
                ]);
            }

            // Delete user and all related data directly
            DB::transaction(function () use ($user) {
                // Delete related records without needing relationships

                // Add other tables as needed

                // Finally delete the user
                $user->delete();
            });

            return response()->json([
                'success' => true,
                'message' => __('User and all related data deleted successfully.')
            ]);
        } catch (\Exception $e) {
            \Log::error('User deletion error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => __('Error deleting user: ') . $e->getMessage()
            ], 500);
        }
    }
    public function activeUser(Request $request)
    {
        if ($request->ajax()) {

            $data = User::where('status', 1)->latest();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('avatar', 'backend.user.include.__avatar')
                ->editColumn('balance', function ($request) {
                    return $request->balance . ' ' . setting('site_currency');
                })
                ->editColumn('total_profit', function ($request) {
                    return $request->total_profit . ' ' . setting('site_currency');
                })
                ->editColumn('email', function ($request) {
                    return safe($request->email);
                })
                ->editColumn('kyc', 'backend.user.include.__kyc')
                ->editColumn('status', 'backend.user.include.__status')
                ->addColumn('action', 'backend.user.include.__action')
                ->rawColumns(['avatar', 'kyc', 'status', 'action'])
                ->make(true);
        }

        return view('backend.user.active_user');
    }

    /**
     * @return Application|Factory|View|JsonResponse
     *
     * @throws Exception
     */
    public function disabled(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('status', 0)->latest();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('avatar', 'backend.user.include.__avatar')
                ->editColumn('kyc', 'backend.user.include.__kyc')
                ->editColumn('status', 'backend.user.include.__status')
                ->editColumn('balance', function ($request) {
                    return $request->balance . ' ' . setting('site_currency');
                })
                ->editColumn('email', function ($request) {
                    return safe($request->email);
                })
                ->editColumn('total_profit', function ($request) {
                    return $request->total_profit . ' ' . setting('site_currency');
                })
                ->addColumn('action', 'backend.user.include.__action')
                ->rawColumns(['avatar', 'kyc', 'status', 'action'])
                ->make(true);
        }

        return view('backend.user.disabled_user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::find($id);
        $level = LevelReferral::where('type', 'investment')->max('the_order') + 1;

        return view('backend.user.edit', compact('user', 'level'));
    }

    /**
     * @return RedirectResponse
     */
    public function statusUpdate($id, Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'status' => 'required',
            'email_verified' => 'required',
            'kyc' => 'required',
            'two_fa' => 'required',
            'deposit_status' => 'required',
            'withdraw_status' => 'required',
            'transfer_status' => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        $data = [
            'status' => $input['status'],
            'kyc' => $input['kyc'],
            'two_fa' => $input['two_fa'],
            'deposit_status' => $input['deposit_status'],
            'withdraw_status' => $input['withdraw_status'],
            'transfer_status' => $input['transfer_status'],
            'email_verified_at' => $input['email_verified'] == 1 ? now() : null,
        ];

        $user = User::find($id);

        if ($user->status != $input['status'] && ! $input['status']) {

            $shortcodes = [
                '[[full_name]]' => $user->full_name,
                '[[site_title]]' => setting('site_title', 'global'),
                '[[site_url]]' => route('home'),
            ];

            $this->mailNotify($user->email, 'user_account_disabled', $shortcodes);
            $this->smsNotify('user_account_disabled', $shortcodes, $user->phone);
        }

        User::find($id)->update($data);

        notify()->success('Status Updated Successfully', 'success');

        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        User::find($id)->update($input);
        notify()->success('User Info Updated Successfully', 'success');

        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function passwordUpdate($id, Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        $password = $validator->validated();

        User::find($id)->update([
            'password' => Hash::make($password['new_password']),
        ]);
        notify()->success('User Password Updated Successfully', 'success');

        return redirect()->back();
    }

    /**
     * @return RedirectResponse|void
     */
    public function balanceUpdate($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        try {

            $amount = $request->amount;
            $type = $request->type;
            $wallet = $request->wallet;

            $user = User::find($id);
            $adminUser = \Auth::user();

            if ($type == 'add') {

                if ($wallet == 'main') {
                    $user->balance += $amount;
                    $user->save();
                } else {
                    $user->profit_balance += $amount;
                    $user->save();
                }

                Txn::new($amount, 0, $amount, 'system', 'Money added in ' . ucwords($wallet) . ' Wallet from System', TxnType::Deposit, TxnStatus::Success, null, null, $id, $adminUser->id, 'Admin');

                $status = 'success';
                $message = __('Account Balance Update');
            } elseif ($type == 'subtract') {

                if ($wallet == 'main') {
                    $user->balance -= $amount;
                    $user->save();
                } else {
                    $user->profit_balance -= $amount;
                    $user->save();
                }

                Txn::new($amount, 0, $amount, 'system', 'Money subtract in ' . ucwords($wallet) . ' Wallet from System', TxnType::Subtract, TxnStatus::Success, null, null, $id, $adminUser->id, 'Admin');
                $status = 'success';
                $message = __('Account Balance Updated');
            }

            notify()->success($message, $status);

            return redirect()->back();
        } catch (Exception $e) {
            $status = 'warning';
            $message = __('something is wrong');
            $code = 503;
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function mailSendAll()
    {
        return view('backend.user.mail_send_all');
    }

    /**
     * @return RedirectResponse
     */
    public function mailSend(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        try {

            $input = [
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            $shortcodes = [
                '[[subject]]' => $input['subject'],
                '[[message]]' => $input['message'],
                '[[site_title]]' => setting('site_title', 'global'),
                '[[site_url]]' => route('home'),
            ];

            if (isset($request->id)) {
                $user = User::find($request->id);

                $shortcodes = array_merge($shortcodes, ['[[full_name]]' => $user->full_name]);

                $this->mailNotify($user->email, 'user_mail', $shortcodes);
            } else {
                $users = User::where('status', 1)->get();

                foreach ($users as $user) {
                    $shortcodes = array_merge($shortcodes, ['[[full_name]]' => $user->full_name]);

                    $this->mailNotify($user->email, 'user_mail', $shortcodes);
                }
            }
            $status = 'success';
            $message = __('Mail Send Successfully');
        } catch (Exception $e) {

            $status = 'warning';
            $message = __('something is wrong');
        }

        notify()->$status($message, $status);

        return redirect()->back();
    }

    /**
     * @return JsonResponse|void
     *
     * @throws Exception
     */
    public function transaction($id, Request $request)
    {

        if ($request->ajax()) {
            $data = Transaction::where('user_id', $id)->latest();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', 'backend.user.include.__txn_status')
                ->editColumn('type', 'backend.user.include.__txn_type')
                ->editColumn('final_amount', 'backend.user.include.__txn_amount')
                ->rawColumns(['status', 'type', 'final_amount'])
                ->make(true);
        }
    }

    /**
     * @return RedirectResponse
     */
    public function userLogin($id)
    {
        Auth::guard('web')->loginUsingId($id);

        return redirect()->route('user.dashboard');
    }
}
