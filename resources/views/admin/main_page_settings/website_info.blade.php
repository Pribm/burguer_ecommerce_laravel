@extends('layouts.navigation.admin')

@section('content')
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header">
                Website Information
            </div>
            <div class="card-body">
                <form method="POST" action={{route("main_page_settings.website")}} enctype="multipart/form-data">
                    @csrf
                    <h4>Settings</h4>
                    <hr>
                    <h5>Site Info</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="site_name" class="form-label">Site Name</label>
                            <input type="text" name="site_name" id="site_name" class="form-control" value="{{$site_info ? $site_info->site_name  : ''}}">
                            <div id="nameHelp" class="form-text">The name of your website.</div>
                            @error('site_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email_address" class="form-label">Email addresss</label>
                            <input type="text" name="email_address" id="email_address" value="{{$site_info ? $site_info->email_address  : ''}}" class="form-control">
                            <div id="nameHelp" class="form-text">This address will be used as the From address in automated e-mails sent by this site.</div>
                            @error('email_address')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="horizontal_logo" class="form-label">Horizontal Logo</label>
                            <div class="input-group mb-3 cursor-pointer" id="horizontal_logo_label">
                                <span class="input-group-text" id="basic-addon3">Add File</span>
                                <input disabled type="text" value="{{$site_info ? $site_info->horizontal_logo  : ''}}" class="form-control cursor-pointer" aria-describedby="basic-addon3">
                                <input type="file" name="horizontal_logo" class="d-none">
                                <div id="nameHelp" class="form-text">Here you can place the horizontal display of your logo, the allowed format is png.</div>
                                @error('horizontal_logo')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="horizontal_logo" class="form-label">Vertical Logo</label>
                            <div class="input-group mb-3 cursor-pointer" id="vertical_logo_label">
                                <span class="input-group-text" id="basic-addon3">Add File</span>
                                <input disabled type="text" class="form-control cursor-pointer" value="{{$site_info ? $site_info->vertical_logo  : ''}}" aria-describedby="basic-addon3">
                                <input type="file" name="vertical_logo" class="d-none">
                                <div id="nameHelp" class="form-text">Here you can place the vertical display of your logo, the allowed format is png.</div>
                                @error('vertical_logo')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="horizontal_logo" class="form-label">Favicon</label>
                            <div class="input-group mb-3 cursor-pointer" id="favicon_label">
                                <span class="input-group-text" id="basic-addon3">Add File</span>
                                <input disabled type="text" class="form-control cursor-pointer" value="{{$site_info ? $site_info->favicon  : ''}}" id="favicon_label" aria-describedby="basic-addon3">
                                <input type="file" name="favicon" class="d-none">
                                <div id="nameHelp" class="form-text">It will be how your logo will be displayed at the navbar of your browser, the allowed format is png.</div>
                                @error('favicon')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Location</h5>

                    <div id='location_container'>
                        <div class="row">
                            <div class="col-md-4 my-2">
                                <label class="m-0">Zipcode</label>

                                <input name="address[0][zipcode]" type="text" class="form-control form-control-sm zipcode" placeholder="Zipcode" value="{{isset($address->zipcode) ? $address->zipcode : ''}}"/>
                                @error('address.0.zipcode')
                                    <strong class="text-danger">{{ $errors->get('address.0.zipcode')[intval(0)] }}</strong>
                                @enderror
                            </div>

                            <div class="col-md-7 my-2">
                                <label class="m-0">Sublocality</label>
                                <input name="address[0][sublocality]"
                                    value="{{isset($address->sublocality) ? $address->sublocality : ''}}"
                                    type="text"
                                    class="form-control form-control-sm sublocality" placeholder="Sublocality" />
                                @error('address.0.sublocality')
                                    <strong
                                        class="text-danger">{{ $errors->get('address.0.sublocality')[0] }}</strong>
                                @enderror
                            </div>

                            <div class="col-md-1 my-2">
                                <label class="m-0">UF</label>
                                <input name="address[0][uf]" type="text" class="form-control form-control-sm state"
                                    value="{{isset($address->state) ? $address->state : ''}}"
                                    placeholder="UF">
                                @error('address.0.uf')
                                    <strong class="text-danger">{{ $errors->get('address.0.uf')[0] }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 my-2">
                                <label class="m-0">City</label>
                                <input name="address[0][city]" type="text" class="form-control form-control-sm city" value="{{isset($address->city) ? $address->city : ''}}"
                                    placeholder="City">
                                @error('address.0.city')
                                    <strong class="text-danger">{{ $errors->get('address.0.city')[0] }}</strong>
                                @enderror
                            </div>

                            <div class="col-md-4 my-2">
                                <label class="m-0">Country</label>
                                <input name="address[0][country]" type="text"
                                    class="form-control form-control-sm country" placeholder="Country" value="{{isset($address->country) ? $address->country : ''}}">
                                @error('address.0.country')
                                    <strong class="text-danger">{{ $errors->get('address.0.country')[0] }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-2 my-2">
                                <label class="m-0">Number</label>
                                <input name="address[0][house_number]" type="text"
                                    class="form-control form-control-sm house_number" placeholder="Nº" value="{{isset($address->house_number) ? $address->house_number : ''}}">
                                @error('address.0.house_number')
                                    <strong class="text-danger">{{ $errors->get('address.0.house_number')[0] }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>


                    <div class="row">
                        <div class="col-md-12">
                            <label for="site_name" class="form-label">Slogan</label>
                            <textarea name="slogan" name="slogan_text" id="" class="form-control" rows="5">{{$site_info ? $site_info->slogan  : ''}}</textarea>
                            <div id="nameHelp" class="form-text">Your site motto, tagline, or catchphrase, if you have one.</div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="site_name" class="form-label">Footer Message</label>
                            <textarea name="footer_message" id="" class="form-control" rows="3">{{$site_info ? $site_info->footer_message  : ''}}</textarea>
                            <div id="nameHelp" class="form-text">This text will be displayed at bottom of each page. It's useful for adding things like copyright notice to your pages.</div>
                        </div>
                    </div>
                    <hr>
                    <h5>Social Media</h5>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="facebook_address" class="form-label">Facebook Address</label>
                            <input class="form-control" name="facebook_address" value="{{$site_info ? $site_info->facebook_address  : ''}}" type="text">
                        </div>

                        <div class="col-md-6">
                            <label for="instagram_address" class="form-label">Instagram Address</label>
                            <input class="form-control" name="instagram_address" value="{{$site_info ? $site_info->instagram_address  : ''}}" type="text">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="twitter_address" class="form-label">Twitter Address</label>
                            <input class="form-control" name="twitter_address" value="{{$site_info ? $site_info->twitter_address  : ''}}" type="text">
                        </div>

                        <div class="col-md-6">
                            <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                            <input class="form-control" name="whatsapp_number" value="{{$site_info ? $site_info->whatsapp_number  : ''}}" type="text">
                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-md-3 ms-auto text-end">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const horizontalLogoLabelInput = document.querySelector('#horizontal_logo_label')
        horizontalLogoLabelInput.addEventListener('click', setFile)

        const verticalLogoLabelInput = document.querySelector('#vertical_logo_label')
        verticalLogoLabelInput.addEventListener('click', setFile)

        const faviconLabelInput = document.querySelector('#favicon_label')
        faviconLabelInput.addEventListener('click', setFile)

        function setFile(e){
            e.target.parentNode.querySelectorAll('input')[1].click()
            e.target.parentNode.querySelectorAll('input')[1].addEventListener('change', () => e.target.parentNode.querySelectorAll('input')[0].value = e.target.parentNode.querySelectorAll('input')[1].files[0].name)
        }

        document.addEventListener('DOMContentLoaded', () => {
            let locationInputs = document.querySelectorAll('#location_container input')
            checkZipcode(locationInputs, 0)
        })

        function checkZipcode(nodeList, formIndex){

            new window.Cleave(nodeList[formIndex], {
                numericOnly: true,
                delimiter: '-',
                blocks: [5,3]
            })

            nodeList[formIndex].addEventListener('input', e => {
                if(nodeList[formIndex].value.length >= 5 && nodeList[formIndex].value.length <= 6)
                {
                    axios.get(window.location.href+'/adress?code='+nodeList[formIndex].value).then(res => {
                        let inputList = e.target.parentNode.parentNode.parentNode.querySelectorAll('input')
                        if(res.data.status === 'OK'){
                            inputList[0].classList.remove('is-invalid')

                            inputList[1].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('route')).length !== 0 ? res.data.results[0].address_components.filter(address_component => address_component.types.includes('route'))[0].long_name +' ,' : ''} ${res.data.results[0].address_components.filter(address_component => address_component.types.includes('sublocality'))[0].long_name}`
                            inputList[2].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('administrative_area_level_1'))[0].short_name}`
                            inputList[3].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('administrative_area_level_2'))[0].long_name}`
                            inputList[4].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('country'))[0].long_name}`
                        }else{

                            inputList[0].classList.add('is-invalid')

                            inputList[1].value = ''
                            inputList[2].value = ''
                            inputList[3].value = ''
                            inputList[4].value = ''
                        }
                    })
                }

                if(nodeList[formIndex].value.length > 8)
                {
                    axios.get(window.location.href+'/adress?code='+nodeList[formIndex].value).then(res => {
                        let inputList = e.target.parentNode.parentNode.parentNode.querySelectorAll('input')
                        if(res.data.status === 'OK'){
                            inputList[1].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('route')).length !== 0 ? res.data.results[0].address_components.filter(address_component => address_component.types.includes('route'))[0].long_name +' ,' : ''} ${res.data.results[0].address_components.filter(address_component => address_component.types.includes('sublocality'))[0].long_name}`
                            inputList[2].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('administrative_area_level_1'))[0].short_name}`
                            inputList[3].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('administrative_area_level_2'))[0].long_name}`
                            inputList[4].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('country'))[0].long_name}`
                        }else{
                            inputList[0].classList.add('is-invalid')

                            inputList[1].value = ''
                            inputList[2].value = ''
                            inputList[3].value = ''
                            inputList[4].value = ''
                        }
                    })
                }
            })
            }
    </script>
@endsection
