<?php

namespace App\Http\Controllers\Settings\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\TransparentImageBackground;
use App\Models\WebsiteSettings;
use Illuminate\Support\Facades\Storage;
use App\Models\Address;

class WebsiteController extends Controller
{
    public function create(){
        $site_info = WebsiteSettings::find(1);
        $address = Address::where('user_id', auth()->user()->id)->first();
        return view('admin.main_page_settings.website_info', ['site_info' => $site_info, 'address' => $address]);
    }

    public function store(Request $request)
    {

        $rules = [
            'address.*.zipcode' => 'required',
            'address.*.sublocality' => 'required',
            'address.*.uf' => 'required',
            'address.*.city' => 'required',
            'address.*.country' => 'required',
            'address.*.house_number' => 'required',
            'site_name' => 'required|min:2|max:128',
            "email_address" => "required|min:8|max:256",
            "slogan" => "max:256",
            "footer_message" => "max:256",
            "horizontal_logo" => ["mimes:png", "max:1024", new TransparentImageBackground('horizontal logo'), 'dimensions:ratio=3/1'],
            "vertical_logo" => ["mimes:png", "max:1024", new TransparentImageBackground('vertical logo'), 'dimensions:ratio=1/1'],
            "favicon" => ["mimes:png,ico", "max:1024", new TransparentImageBackground('favicon'), 'dimensions:width=16,height=16'],
        ];

        $feedback = [
            'user.email.unique' => 'The user email has already been taken.',
            'address.*.zipcode.required' => 'We need at least one zipcode to proceed',
            'address.*.sublocality.required' => 'We need at least one sublocality to proceed',
            'address.*.uf.required' => 'Add a UF',
            'address.*.city.required' => 'We need at least one city to proceed',
            'address.*.country.required' => 'We need at least one country to proceed',
            'address.*.house_number.required' => 'We need at least one house number to proceed',
            'horizontal_logo.dimensions' => 'The aspect ratio from your horizontal logo must be 3:1',
            'vertical_logo.dimensions' => 'The aspect ratio from your vertical logo must be 1:1',
            'favicon.dimensions' => 'The size of your favicon must be 16x16',
        ];
        $request->validate($rules, $feedback );

        if($request->hasFile('horizontal_logo') || $request->hasFile('vertical_logo') || $request->hasFile('favicon')){
            $image_path = 'website/images';
            Storage::disk('public')->deleteDirectory('website/images');
            $website_data = $request->all();
            $request->horizontal_logo ? $website_data['horizontal_logo'] = 'horizontal_logo' . '.'. $request->file('horizontal_logo')->getClientOriginalExtension() : $website_data['horizontal_logo'] = null;
            $request->vertical_logo ? $website_data['vertical_logo'] = 'vertical_logo' . '.'. $request->file('vertical_logo')->getClientOriginalExtension() : $website_data['vertical_logo'] = null;
            $request->favicon ? $website_data['favicon'] = 'favicon' . '.'. $request->file('favicon')->getClientOriginalExtension() : $website_data['favicon'] = null;

            if($website_data['horizontal_logo']) Storage::disk('public')->putFileAs($image_path, $request->file('horizontal_logo'), $website_data['horizontal_logo']);
            if($website_data['vertical_logo']) Storage::disk('public')->putFileAs($image_path, $request->file('vertical_logo'), $website_data['vertical_logo']);
            if($website_data['favicon']) Storage::disk('public')->putFileAs($image_path, $request->file('favicon'), $website_data['favicon']);

            WebsiteSettings::updateOrCreate(['id' => 1],$website_data);

            return redirect()->route('main_page_settings.website');
        }

        foreach ($request->address as $address) {
            Address::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'zipcode' => $address['zipcode'],
                'sublocality' => $address['sublocality'],
                'state' => $address['uf'],
                'city' => $address['city'],
                'country' => $address['country'],
                'house_number' => $address['house_number']
            ]);
        }

        WebsiteSettings::updateOrCreate(['id' => 1],$request->except(['_token']));
        return redirect()->route('main_page_settings.website');
    }
}
