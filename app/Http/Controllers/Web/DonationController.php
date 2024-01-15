<?php


namespace App\Http\Controllers\Web;

use App\Models\Donation;
use Illuminate\Http\Request;

use App\Models\Utilities\WebServiceAPI;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $webAPI = new WebServiceAPI();
        $response = \json_decode($webAPI->getDonations(null));
        unset($webAPI);
        $donations = $response->data;
        return view('donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $webAPI = new WebServiceAPI();
        $categories = \json_decode($webAPI->getCategories(null));
        $currrencies = \json_decode($webAPI->getCurrencies(null));
        unset($webAPI);
        $categories = $categories->data;
        $currencies = $currrencies->data;
        $donation_types = Donation::donationTypes();
        return view('donations.create', compact('categories', 'currencies', 'donation_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $webAPI = new WebServiceAPI();
        $donation_details = [
            "user_id" => session(0)->id,
            "category_id" => $request['category_id'],
            "currency_id" => $request['currency_id'],
            "title" => $request['title'],
            "donation_img" => $request['donation_img'],
            "description" => $request['description'],
            "target_amount" => $request['target_amount'],
            "type" => $request['type'],
        ];
        $donation_details = \json_encode($donation_details);
        $response = \json_decode($webAPI->createDonation($donation_details));
        unset($webAPI);
        if ($response->status) {
            return redirect()->route('donations')->withInput()->with('donation_creation_successful', "$response->message");
        } else {
            return redirect()->route('donation.create')->withInput()->with('donation_creation_error', "$response->message");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $webAPI = new WebServiceAPI();
        $response = \json_decode($webAPI->findDonation($id));
        unset($webAPI);

        $donation = $response->data;
        // Getting Initiator Details 
        $initiator_details = array_filter(
            $donation->relationships->users,
            fn ($user) => $user->pivot->is_initiator == true
        );
        $initiator_details = $initiator_details[0];

        // Getting total numbers of unique donators
        $donators = [];
        foreach ($donation->relationships->users as $user) {
            if ((int)$user->pivot->amount_contributed > 0) {
                array_push($donators, $user->pivot->user_id);
            }
        }
        $unique_donators = count(array_unique($donators));
        $donators = count($donators);
        // Percentage progress of the donation
        $progress = ($donation->attributes->contributed_amount / $donation->attributes->target_amount) * 100;
        return view('donations.show', compact('donation', 'initiator_details', 'unique_donators', 'progress', 'donators'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $webAPI = new WebServiceAPI();
        $categories = \json_decode($webAPI->getCategories(null));
        $currrencies = \json_decode($webAPI->getCurrencies(null));
        $response = \json_decode($webAPI->findDonation($id));
        unset($webAPI);
        $categories = $categories->data;
        $currencies = $currrencies->data;
        $donation_types = Donation::donationTypes();
        $donation = $response->data;
        return view('donations.edit', compact('donation', 'categories', 'currencies', 'donation_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $webAPI = new WebServiceAPI();
        $donation_details = [
            "user_id" => session(0)->id,
            "category_id" => $request['category_id'],
            "currency_id" => $request['currency_id'],
            "title" => $request['title'],
            "donation_img" => $request['donation_img'],
            "description" => $request['description'],
            "target_amount" => $request['target_amount'],
            "type" => $request['type'],
        ];
        $donation_details = \json_encode($donation_details);
        $response = \json_decode($webAPI->updateDonation($donation_details, $id));
        unset($webAPI);
        if ($response->status) {
            return redirect()->route('my_donations')->withInput()->with('donation_update_successful', "$response->message");
        } else {
            $url = '/donation/' . $id . '/edit';
            return redirect($url)->withInput()->with('donation_update_error', "$response->message");
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $webAPI = new WebServiceAPI();
        $response = \json_decode($webAPI->deleteDonation($id));
        unset($webAPI);
        if ($response->status) {
            return redirect()->route('my_donations')->withInput()->with('donation_delete_successful', "$response->message");
        } else {
            return redirect()->route('my_donations')->withInput()->with('donation_delete_error', "$response->message");
        }
    }

    /**
     * Donate.
     */
    public function donate(Request $request)
    {
        $webAPI = new WebServiceAPI();
        $user_donation_details = [
            "user_id" => $request['user_id'],
            "donation_id" => $request['donation_id'],
            "amount_contributed" => $request['amount_contributed'],
        ];
        $user_donation_details = \json_encode($user_donation_details);
        $response = \json_decode($webAPI->donate($user_donation_details));
        unset($webAPI);
        if ($response->status) {
            return redirect()->route('donations')->withInput()->with('donation_succesful', "$response->message");
        } else {
            $url = "/donation/" . $request['donation_id'];
            return redirect($url)->withInput()->with('donation_error', "$response->message");
        }
    }

    /**
     * Donate.
     */
    public function myDonations()
    {
        $user_id = session(0)->id;
        $webAPI = new WebServiceAPI();
        $response = \json_decode($webAPI->myDonations($user_id));
        $user = $response->data;
        unset($webAPI);
        $webAPI = new WebServiceAPI();


        /*========Getting Contributions Made Per Donation====*/
        // Getting total numbers of unique donations
        $donation_data = [];
        $donations = [];
        foreach ($user->relationships->donations as $user_d) {
            array_push($donations, $user_d->pivot->donation_id);
        }
        $unique_donations = array_unique($donations);
        // Getting Contributions Per Donations
        foreach ($unique_donations as $donation_id) {
            $response = \json_decode($webAPI->findDonation($donation_id));
            $donation = $response->data;
            // Getting Contributions count
            $contributions_details = array_filter(
                $donation->relationships->users,
                fn ($user) => $user->pivot->user_id == $user_id
            );
            // Updating to keep track of new data
            $donation->attributes->total_contributions = count($contributions_details);
            $donation->attributes->contribution_details = $contributions_details;
            array_push($donation_data,$donation);
        }
        unset($webAPI);

        return view('donations.my-donations', compact('donation_data'));
    }
}
