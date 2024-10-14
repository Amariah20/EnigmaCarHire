@extends('layouts.app')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('storeCustomer') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="license number" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('License Number') }}</label>

                            <div class="col-md-6">
                                <input id="license_number" type="text" class="form-control @error('license_number') is-invalid @enderror" name="license_number" value="{{ old('license_number') }}" required autocomplete="license number" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Issuing Country') }}</label>

                            <div class="col-md-6">
                                        <select class="form-control @error('issuing_country') is-invalid @enderror" name="issuing_country" required>
                                            <option value="">Select Country</option>
                                            <option value="Afghanistan" {{ old('issuing_country') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                            <option value="Albania" {{ old('issuing_country') == 'Albania' ? 'selected' : '' }}>Albania</option>
                                            <option value="Algeria" {{ old('issuing_country') == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                            <option value="Andorra" {{ old('issuing_country') == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                            <option value="Angola" {{ old('issuing_country') == 'Angola' ? 'selected' : '' }}>Angola</option>
                                            <option value="Antigua and Barbuda" {{ old('issuing_country') == 'Antigua and Barbuda' ? 'selected' : '' }}>Antigua and Barbuda</option>
                                            <option value="Argentina" {{ old('issuing_country') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                            <option value="Armenia" {{ old('issuing_country') == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                                            <option value="Australia" {{ old('issuing_country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                            <option value="Austria" {{ old('issuing_country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                            <option value="Azerbaijan" {{ old('issuing_country') == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                                            <option value="Bahamas" {{ old('issuing_country') == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                                            <option value="Bahrain" {{ old('issuing_country') == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                                            <option value="Bangladesh" {{ old('issuing_country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                            <option value="Barbados" {{ old('issuing_country') == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                                            <option value="Belarus" {{ old('issuing_country') == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                                            <option value="Belgium" {{ old('issuing_country') == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                            <option value="Belize" {{ old('issuing_country') == 'Belize' ? 'selected' : '' }}>Belize</option>
                                            <option value="Benin" {{ old('issuing_country') == 'Benin' ? 'selected' : '' }}>Benin</option>
                                            <option value="Bhutan" {{ old('issuing_country') == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                                            <option value="Bolivia" {{ old('issuing_country') == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                                            <option value="Bosnia and Herzegovina" {{ old('issuing_country') == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                            <option value="Botswana" {{ old('issuing_country') == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                                            <option value="Brazil" {{ old('issuing_country') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                            <option value="Brunei" {{ old('issuing_country') == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                                            <option value="Bulgaria" {{ old('issuing_country') == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                                            <option value="Burkina Faso" {{ old('issuing_country') == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                                            <option value="Burundi" {{ old('issuing_country') == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                                            <option value="Cabo Verde" {{ old('issuing_country') == 'Cabo Verde' ? 'selected' : '' }}>Cabo Verde</option>
                                            <option value="Cambodia" {{ old('issuing_country') == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                                            <option value="Cameroon" {{ old('issuing_country') == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                            <option value="Canada" {{ old('issuing_country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                            <option value="Central African Republic" {{ old('issuing_country') == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                                            <option value="Chad" {{ old('issuing_country') == 'Chad' ? 'selected' : '' }}>Chad</option>
                                            <option value="Chile" {{ old('issuing_country') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                            <option value="China" {{ old('issuing_country') == 'China' ? 'selected' : '' }}>China</option>
                                            <option value="Colombia" {{ old('issuing_country') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                            <option value="Comoros" {{ old('issuing_country') == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                                            <option value="Congo" {{ old('issuing_country') == 'Congo' ? 'selected' : '' }}>Congo</option>
                                            <option value="Costa Rica" {{ old('issuing_country') == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                            <option value="Croatia" {{ old('issuing_country') == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                                            <option value="Cuba" {{ old('issuing_country') == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                                            <option value="Cyprus" {{ old('issuing_country') == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                                            <option value="Czech Republic" {{ old('issuing_country') == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                            <option value="Denmark" {{ old('issuing_country') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                            <option value="Djibouti" {{ old('issuing_country') == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                                            <option value="Dominica" {{ old('issuing_country') == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                                            <option value="Dominican Republic" {{ old('issuing_country') == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                            <option value="East Timor" {{ old('issuing_country') == 'East Timor' ? 'selected' : '' }}>East Timor</option>
                                            <option value="Ecuador" {{ old('issuing_country') == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                                            <option value="Egypt" {{ old('issuing_country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                            <option value="El Salvador" {{ old('issuing_country') == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                                            <option value="Equatorial Guinea" {{ old('issuing_country') == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
                                            <option value="Eritrea" {{ old('issuing_country') == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                                            <option value="Estonia" {{ old('issuing_country') == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                                            <option value="Eswatini" {{ old('issuing_country') == 'Eswatini' ? 'selected' : '' }}>Eswatini</option>
                                            <option value="Ethiopia" {{ old('issuing_country') == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                                            <option value="Fiji" {{ old('issuing_country') == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                                            <option value="Finland" {{ old('issuing_country') == 'Finland' ? 'selected' : '' }}>Finland</option>
                                            <option value="France" {{ old('issuing_country') == 'France' ? 'selected' : '' }}>France</option>
                                            <option value="Gabon" {{ old('issuing_country') == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                                            <option value="Gambia" {{ old('issuing_country') == 'Gambia' ? 'selected' : '' }}>Gambia</option>
                                            <option value="Georgia" {{ old('issuing_country') == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                                            <option value="Germany" {{ old('issuing_country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                            <option value="Ghana" {{ old('issuing_country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                            <option value="Greece" {{ old('issuing_country') == 'Greece' ? 'selected' : '' }}>Greece</option>
                                            <option value="Grenada" {{ old('issuing_country') == 'Grenada' ? 'selected' : '' }}>Grenada</option>
                                            <option value="Guatemala" {{ old('issuing_country') == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                                            <option value="Guinea" {{ old('issuing_country') == 'Guinea' ? 'selected' : '' }}>Guinea</option>
                                            <option value="Guinea-Bissau" {{ old('issuing_country') == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>
                                            <option value="Guyana" {{ old('issuing_country') == 'Guyana' ? 'selected' : '' }}>Guyana</option>
                                            <option value="Haiti" {{ old('issuing_country') == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                                            <option value="Honduras" {{ old('issuing_country') == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                                            <option value="Hungary" {{ old('issuing_country') == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                                            <option value="Iceland" {{ old('issuing_country') == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                                            <option value="India" {{ old('issuing_country') == 'India' ? 'selected' : '' }}>India</option>
                                            <option value="Indonesia" {{ old('issuing_country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                            <option value="Iran" {{ old('issuing_country') == 'Iran' ? 'selected' : '' }}>Iran</option>
                                            <option value="Iraq" {{ old('issuing_country') == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                            <option value="Ireland" {{ old('issuing_country') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                            <option value="Israel" {{ old('issuing_country') == 'Israel' ? 'selected' : '' }}>Israel</option>
                                            <option value="Italy" {{ old('issuing_country') == 'Italy' ? 'selected' : '' }}>Italy</option>
                                            <option value="Jamaica" {{ old('issuing_country') == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                                            <option value="Japan" {{ old('issuing_country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                            <option value="Jordan" {{ old('issuing_country') == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                                            <option value="Kazakhstan" {{ old('issuing_country') == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                                            <option value="Kenya" {{ old('issuing_country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                            <option value="Kiribati" {{ old('issuing_country') == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
                                            <option value="Korea, North" {{ old('issuing_country') == 'Korea, North' ? 'selected' : '' }}>Korea, North</option>
                                            <option value="Korea, South" {{ old('issuing_country') == 'Korea, South' ? 'selected' : '' }}>Korea, South</option>
                                            <option value="Kuwait" {{ old('issuing_country') == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                            <option value="Kyrgyzstan" {{ old('issuing_country') == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                                            <option value="Laos" {{ old('issuing_country') == 'Laos' ? 'selected' : '' }}>Laos</option>
                                            <option value="Latvia" {{ old('issuing_country') == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                                            <option value="Lebanon" {{ old('issuing_country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                                            <option value="Lesotho" {{ old('issuing_country') == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                                            <option value="Liberia" {{ old('issuing_country') == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                                            <option value="Libya" {{ old('issuing_country') == 'Libya' ? 'selected' : '' }}>Libya</option>
                                            <option value="Liechtenstein" {{ old('issuing_country') == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
                                            <option value="Lithuania" {{ old('issuing_country') == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                                            <option value="Luxembourg" {{ old('issuing_country') == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                            <option value="Madagascar" {{ old('issuing_country') == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                                            <option value="Malawi" {{ old('issuing_country') == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                                            <option value="Malaysia" {{ old('issuing_country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                            <option value="Maldives" {{ old('issuing_country') == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                                            <option value="Mali" {{ old('issuing_country') == 'Mali' ? 'selected' : '' }}>Mali</option>
                                            <option value="Malta" {{ old('issuing_country') == 'Malta' ? 'selected' : '' }}>Malta</option>
                                            <option value="Marshall Islands" {{ old('issuing_country') == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>
                                            <option value="Mauritania" {{ old('issuing_country') == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                                            <option value="Mauritius" {{ old('issuing_country') == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                                            <option value="Mexico" {{ old('issuing_country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                            <option value="Micronesia" {{ old('issuing_country') == 'Micronesia' ? 'selected' : '' }}>Micronesia</option>
                                            <option value="Moldova" {{ old('issuing_country') == 'Moldova' ? 'selected' : '' }}>Moldova</option>
                                            <option value="Monaco" {{ old('issuing_country') == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                                            <option value="Mongolia" {{ old('issuing_country') == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                                            <option value="Montenegro" {{ old('issuing_country') == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
                                            <option value="Morocco" {{ old('issuing_country') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                            <option value="Mozambique" {{ old('issuing_country') == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                                            <option value="Myanmar" {{ old('issuing_country') == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                                            <option value="Namibia" {{ old('issuing_country') == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                                            <option value="Nauru" {{ old('issuing_country') == 'Nauru' ? 'selected' : '' }}>Nauru</option>
                                            <option value="Nepal" {{ old('issuing_country') == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                            <option value="Netherlands" {{ old('issuing_country') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                            <option value="New Zealand" {{ old('issuing_country') == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                            <option value="Nicaragua" {{ old('issuing_country') == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                                            <option value="Niger" {{ old('issuing_country') == 'Niger' ? 'selected' : '' }}>Niger</option>
                                            <option value="Nigeria" {{ old('issuing_country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                            <option value="North Macedonia" {{ old('issuing_country') == 'North Macedonia' ? 'selected' : '' }}>North Macedonia</option>
                                            <option value="Norway" {{ old('issuing_country') == 'Norway' ? 'selected' : '' }}>Norway</option>
                                            <option value="Oman" {{ old('issuing_country') == 'Oman' ? 'selected' : '' }}>Oman</option>
                                            <option value="Pakistan" {{ old('issuing_country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                            <option value="Palau" {{ old('issuing_country') == 'Palau' ? 'selected' : '' }}>Palau</option>
                                            <option value="Panama" {{ old('issuing_country') == 'Panama' ? 'selected' : '' }}>Panama</option>
                                            <option value="Papua New Guinea" {{ old('issuing_country') == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>
                                            <option value="Paraguay" {{ old('issuing_country') == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                                            <option value="Peru" {{ old('issuing_country') == 'Peru' ? 'selected' : '' }}>Peru</option>
                                            <option value="Philippines" {{ old('issuing_country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                            <option value="Poland" {{ old('issuing_country') == 'Poland' ? 'selected' : '' }}>Poland</option>
                                            <option value="Portugal" {{ old('issuing_country') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                            <option value="Qatar" {{ old('issuing_country') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                            <option value="Romania" {{ old('issuing_country') == 'Romania' ? 'selected' : '' }}>Romania</option>
                                            <option value="Russia" {{ old('issuing_country') == 'Russia' ? 'selected' : '' }}>Russia</option>
                                            <option value="Rwanda" {{ old('issuing_country') == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                            <option value="Saint Kitts and Nevis" {{ old('issuing_country') == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia" {{ old('issuing_country') == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
                                            <option value="Saint Vincent and the Grenadines" {{ old('issuing_country') == 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                                            <option value="Samoa" {{ old('issuing_country') == 'Samoa' ? 'selected' : '' }}>Samoa</option>
                                            <option value="San Marino" {{ old('issuing_country') == 'San Marino' ? 'selected' : '' }}>San Marino</option>
                                            <option value="Sao Tome and Principe" {{ old('issuing_country') == 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and Principe</option>
                                            <option value="Saudi Arabia" {{ old('issuing_country') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                            <option value="Senegal" {{ old('issuing_country') == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                                            <option value="Serbia" {{ old('issuing_country') == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                                            <option value="Seychelles" {{ old('issuing_country') == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                                            <option value="Sierra Leone" {{ old('issuing_country') == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                                            <option value="Singapore" {{ old('issuing_country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                            <option value="Slovakia" {{ old('issuing_country') == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                                            <option value="Slovenia" {{ old('issuing_country') == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                                            <option value="Solomon Islands" {{ old('issuing_country') == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>
                                            <option value="Somalia" {{ old('issuing_country') == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                                            <option value="South Africa" {{ old('issuing_country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                            <option value="South Sudan" {{ old('issuing_country') == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
                                            <option value="Spain" {{ old('issuing_country') == 'Spain' ? 'selected' : '' }}>Spain</option>
                                            <option value="Sri Lanka" {{ old('issuing_country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                            <option value="Sudan" {{ old('issuing_country') == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                                            <option value="Sweden" {{ old('issuing_country') == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                            <option value="Switzerland" {{ old('issuing_country') == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                            <option value="Syria" {{ old('issuing_country') == 'Syria' ? 'selected' : '' }}>Syria</option>
                                            <option value="Taiwan" {{ old('issuing_country') == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
                                            <option value="Tajikistan" {{ old('issuing_country') == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                                            <option value="Tanzania" {{ old('issuing_country') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                                            <option value="Thailand" {{ old('issuing_country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                            <option value="Togo" {{ old('issuing_country') == 'Togo' ? 'selected' : '' }}>Togo</option>
                                            <option value="Tonga" {{ old('issuing_country') == 'Tonga' ? 'selected' : '' }}>Tonga</option>
                                            <option value="Trinidad and Tobago" {{ old('issuing_country') == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
                                            <option value="Tunisia" {{ old('issuing_country') == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                                            <option value="Turkey" {{ old('issuing_country') == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                            <option value="Turkmenistan" {{ old('issuing_country') == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                                            <option value="Tuvalu" {{ old('issuing_country') == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
                                            <option value="Uganda" {{ old('issuing_country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                            <option value="Ukraine" {{ old('issuing_country') == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                            <option value="United Arab Emirates" {{ old('issuing_country') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                                            <option value="United Kingdom" {{ old('issuing_country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                            <option value="United States" {{ old('issuing_country') == 'United States' ? 'selected' : '' }}>United States</option>
                                            <option value="Uruguay" {{ old('issuing_country') == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                                            <option value="Uzbekistan" {{ old('issuing_country') == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                                            <option value="Vanuatu" {{ old('issuing_country') == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
                                            <option value="Vatican City" {{ old('issuing_country') == 'Vatican City' ? 'selected' : '' }}>Vatican City</option>
                                            <option value="Venezuela" {{ old('issuing_country') == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                            <option value="Vietnam" {{ old('issuing_country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                            <option value="Yemen" {{ old('issuing_country') == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                                            <option value="Zambia" {{ old('issuing_country') == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                                            <option value="Zimbabwe" {{ old('issuing_country') == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                                        

                               </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
