<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\Contact;
use App\Models\SocialMedia;
use App\Models\CreatePage;
use App\Models\Religion;
use App\Models\MaritalStatus;
use App\Models\Degree;
use App\Models\Working;
use App\Models\Profession;
use App\Models\Country;
use App\Models\Location;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $generalsetting = GeneralSetting::where('status',1)->limit(1)->first();
        view()->share('generalsetting',$generalsetting);
        // general setting end

        $contact = Contact::where('status',1)->limit(1)->first();
        view()->share('contact',$contact);
        // contact end

        $socialmedia = SocialMedia::where('status',1)->get();
        view()->share('socialmedia',$socialmedia);
        // contact end

        $socialicons = SocialMedia::where('status',1)->get();
        view()->share('socialicons',$socialicons);
        // contact end

        $footer_left = CreatePage::where(['status'=>1,'position'=>1])->limit(5)->get();
        view()->share('footer_left',$footer_left);

        $footer_right = CreatePage::where(['status'=>1,'position'=>2])->limit(5)->get();
        view()->share('footer_right',$footer_right);
        // Footermenu end

        $religions = Religion::where('status', 1)->get();
        view()->share('religions', $religions);

        $maritalstatuses = MaritalStatus::where('status', 1)->get();
        view()->share('maritalstatuses', $maritalstatuses);

        $edulevels = Degree::where('parent_id', 0)->get();
        view()->share('edulevels', $edulevels);

        $professions = Profession::where(['status' => 1])->get();
        view()->share('professions', $professions);

        $workings = Working::get();
        view()->share('workings', $workings);

        $countries = Country::get();
        view()->share('countries', $countries);
        
        $locations = Location::where(['district_id' => 0, 'division_id' => 0])->orderBy('serial', 'asc')->get();
        view()->share('locations', $locations);

        $districts = Location::where(['district_id' => 0, 'division_id' => $request->division])->whereNot('division_id', 0)->orderBy('title', 'asc')->get();
        view()->share('districts', $districts);

        $upazilas = Location::where('district_id', $request->district)->get();
        view()->share('upazilas', $upazilas);

    }
}
