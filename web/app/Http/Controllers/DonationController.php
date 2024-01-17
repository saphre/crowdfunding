<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


// Models
use App\Models\Donation;
use App\Models\User;
//Requests
use App\Http\Requests\StoreUserDonationRequest;
use App\Http\Requests\DonationRequest;
//Traits
use App\Traits\HttpResponses;
//Resources
use App\Http\Resources\DonationResource;
use App\Http\Resources\UserResource;


class DonationController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return DonationResource::collection(Donation::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $donation_request = new DonationRequest();
        try {
            $validateDonation = Validator::make(
                $request->except(['_token']),
                $donation_request->store()
            );

            if ($validateDonation->fails()) {
                return $this->error('', 'An Error Occurred : Validation error', $validateDonation->errors(), 422);
            }

            // DB Transaction
            DB::beginTransaction();
            $created_donation =  Donation::create([
                "category_id" => $request['category_id'],
                "currency_id" => $request['currency_id'],
                "title" => $request['title'],
                "donation_img" => $request['donation_img'],
                "description" => $request['description'],
                "target_amount" => $request['target_amount'],
                "type" => $request['type'],
            ]);
            DB::table('users_donations')->insert([
                'user_id' => $request->user_id,
                'donation_id' => $created_donation->id,
                'is_initiator' => true,
            ]);
            // DB Commit
            DB::commit();
            return $this->success('', 'Donation Creation Successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error('', "ERROR", $th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new DonationResource(Donation::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donation_request = new DonationRequest();
        try {
            $validateDonation = Validator::make(
                $request->except(['_token']),
                $donation_request->update()
            );

            if ($validateDonation->fails()) {
                return $this->error('', 'An Error Occurred : Validation error', $validateDonation->errors(), 422);
            }
            $input = $request->except(['_token']);

            // DB Transaction
            DB::beginTransaction();
            $donation = Donation::findOrFail($id);
            $donation->update($input);
            $donation->updated_at = date("Y-m-d H:i:s");
            $donation->update();
            // DB Commit
            DB::commit();
            return $this->success('', 'Donation Successfully Updated');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error('', "ERROR : Please Try Again", $th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        try {

            // DB Transaction
            DB::beginTransaction();
            $donation = Donation::findOrFail($id);
            $donation->delete();
            // DB Commit
            DB::commit();
            return $this->success('', 'Donation Successfully Deleted');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error('', "ERROR : Please Try Again", $th->getMessage(), 500);
        }
    }

    /**
     * Make a donation.
     */
    public function donate(Request $request)
    {
        $user_donation_request = new StoreUserDonationRequest();
        try {
            $validateUserDonation = Validator::make(
                $request->except(['_token']),
                $user_donation_request->rules()
            );

            if ($validateUserDonation->fails()) {
                return $this->error('', 'Validation error', $validateUserDonation->errors(), 422);
            }

            unset($user_donation_request);
            // Getting Initiator Details 
            $donation = Donation::findOrFail($request->donation_id);
            $initiator_details =  DB::table('users_donations')->where([
                ['donation_id', '=', $donation->id],
                ['is_initiator', '=', true]
            ])->get()[0];
            $is_initiator = ($initiator_details->id == $request->user_id) ? true : false;

            // DB Transaction
            DB::beginTransaction();
            DB::table('users_donations')->insert([
                'user_id' => $request->user_id,
                'donation_id' => $request->donation_id,
                'is_initiator' => $is_initiator,
                'amount_contributed' => $request->amount_contributed,
            ]);
            // Updating Donation
            $contributed_amount = (int)$donation->contributed_amount + (int)$request->amount_contributed;
            $donation->contributed_amount = $contributed_amount;
            $donation->is_complete = ($contributed_amount >= (int)$donation->target_amount) ? true : false;
            $donation->update();
            // DB Commit
            DB::commit();
            return $this->success('', 'Donation Successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error('', "ERROR", $th->getMessage(), 500);
        }
    }

    /**
     * My donations.
     */
    public function myDonations(string $id)
    {
        return new UserResource(User::find($id));
    }
}
