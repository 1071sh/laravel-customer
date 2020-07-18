<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * 顧客一覧表示
     * スーパーバイザーは全店舗の顧客を見られる
     * 以外は自分が所属する顧客のみ表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 顧客情報はスーパーバイザーであれば 全店舗の顧客情報を閲覧できますが、店員の場合は自分が所属する店舗の顧客情報しか閲覧できません。
        if (auth()->user()->isSuserVisor()) {
            $customers = Customer::paginate();  //デフォルトでは１ページに１５件表示
        } else {
            $customers = Customer::where('shop_id', auth()->user()['shop_id'])->paginate();
        }
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = $this->validateCustomer();  //バリデーション関数を呼び出し
        $customer = Customer::create($attribute); //顧客情報をデータベースに新規登録
        return redirect('/customers'); //顧客一覧画面に遷移
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        // CustomerPolicy.phpのview関数を呼んで スーパーバイザーでなければ ユーザーの所属する顧客しか見られないように制御
        $this->authorize('view', $customer);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }


    /**
    * 顧客登録処理のバリデーションを行います
    * @return mixed
    */
    protected function validateCustomer()
    {
        return request()->validate([
            'name' => ['required', 'min:3', 'max:32'],
            'shop_id' => ['required', 'Numeric', 'Between:1,3'],
            'postal' => ['required',],
            'address' => ['required',],
            'email' => ['required', 'E-Mail'],
            'birthdate' => ['required', 'Date'],
            'phone' => ['required',],
            'kramer_flag' => ['required', 'Numeric', 'Between:0,1'],
        ]);
    }
}
