<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Config;
use App\Customer;

class CustomerController extends Controller {
    
   public function getAllCustomers()
    {
        $customers = Customer::all();
       
        return $customers;
    }
    
    
     public function getCustomer(Request $request, $idCustomer)
    {
        $customer = Customer::find($idCustomer);

        return $customer;
    }

    /**
     * Create event.
     */
    public function createCustomer(Request $request)
    {
        $customer = new Customer;
        $customer->last_name = $request->input('last_name');
        $customer->first_name = $request->input('first_name');
        $customer->mail = $request->input('mail');
        $customer->adress = $request->input('adress');
        $customer->zip_code = $request->input('zip_code');
        $customer->siret = $request->input('siret');
        $customer->company_name = $request->input('company_name');
        $customer->save();
    }
}