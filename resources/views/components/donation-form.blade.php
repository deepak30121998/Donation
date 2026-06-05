@props([
    'causes' => null,
])

<!-- Campaign Donation Form Start -->
<div class="donate-form campaign-donate-form">
    <form id="donateForm" action="{{ route('donation.store') }}" method="POST">
        @csrf

        <!-- Amount Section Start -->
        <div class="campaign-donate-value wow fadeInUp" data-wow-delay="0.4s">
            <div class="form-group mb-4">
                <input type="text"
                       name="custom_amount"
                       class="form-control"
                       id="custom_amount"
                       placeholder="Donate Now ..."
                       value="{{ old('custom_amount') }}">
                <div class="help-block with-errors"></div>
            </div>

            <fieldset class="donate-value-box">
                <div class="donate-value">
                    <input type="radio" id="value1" name="amount" value="100" {{ old('amount', '100') === '100' ? 'checked' : '' }}>
                    <label for="value1">$ 100.00</label>
                </div>

                <div class="donate-value">
                    <input type="radio" id="value2" name="amount" value="200" {{ old('amount') === '200' ? 'checked' : '' }}>
                    <label for="value2">$ 200.00</label>
                </div>

                <div class="donate-value">
                    <input type="radio" id="value3" name="amount" value="300" {{ old('amount') === '300' ? 'checked' : '' }}>
                    <label for="value3">$ 300.00</label>
                </div>

                <div class="donate-value">
                    <input type="radio" id="value4" name="amount" value="400" {{ old('amount') === '400' ? 'checked' : '' }}>
                    <label for="value4">$ 400.00</label>
                </div>

                <div class="donate-value">
                    <input type="radio" id="value5" name="amount" value="500" {{ old('amount') === '500' ? 'checked' : '' }}>
                    <label for="value5">$ 500.00</label>
                </div>

                <div class="donate-value">
                    <input type="radio" id="value6" name="amount" value="600" {{ old('amount') === '600' ? 'checked' : '' }}>
                    <label for="value6">$ 600.00</label>
                </div>
            </fieldset>
        </div>
        <!-- Amount Section End -->

        @if ($causes && $causes->isNotEmpty())
            <!-- Cause Selection Start -->
            <div class="form-group mb-4 wow fadeInUp" data-wow-delay="0.5s">
                <select name="cause_id" class="form-control" id="cause_id">
                    <option value="">-- Select a Cause --</option>
                    @foreach ($causes as $cause)
                        <option value="{{ $cause->id }}" {{ old('cause_id', request('cause')) == $cause->id ? 'selected' : '' }}>
                            {{ $cause->title }}
                        </option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
            </div>
            <!-- Cause Selection End -->
        @endif

        <!-- Donation Payment Method Start -->
        <div class="donate-payment-method">
            <div class="section-title">
                <h2 class="text-anime-style-2" data-cursor="-opaque">Select <span>payment method</span></h2>
            </div>
            <div class="donate-payment-type wow fadeInUp" data-wow-delay="0.6s">
                <div class="payment-method">
                    <input type="radio" id="payment_test" name="payment_method" value="test"
                           {{ old('payment_method', 'test') === 'test' ? 'checked' : '' }}>
                    <label for="payment_test">test donation</label>
                </div>
                <div class="payment-method">
                    <input type="radio" id="payment_offline" name="payment_method" value="offline"
                           {{ old('payment_method') === 'offline' ? 'checked' : '' }}>
                    <label for="payment_offline">offline donation</label>
                </div>
            </div>
        </div>
        <!-- Donation Payment Method End -->

        <!-- Donor Personal Info Start -->
        <div class="donar-personal-info">
            <div class="section-title">
                <h2 class="text-anime-style-2" data-cursor="-opaque">Personal <span>info</span></h2>
            </div>

            <div class="row wow fadeInUp" data-wow-delay="0.8s">
                <div class="form-group col-md-6 mb-4">
                    <input type="text"
                           name="donor_first_name"
                           class="form-control"
                           id="fname"
                           placeholder="First name"
                           value="{{ old('donor_first_name') }}"
                           required>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-6 mb-4">
                    <input type="text"
                           name="donor_last_name"
                           class="form-control"
                           id="lname"
                           placeholder="Last name"
                           value="{{ old('donor_last_name') }}"
                           required>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-12 mb-4">
                    <input type="email"
                           name="donor_email"
                           class="form-control"
                           id="donate_email"
                           placeholder="Enter your e-mail"
                           value="{{ old('donor_email') }}"
                           required>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-12 mb-4">
                    <input type="text"
                           name="donor_phone"
                           class="form-control"
                           id="phone"
                           placeholder="Enter your phone no."
                           value="{{ old('donor_phone') }}">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-12 mb-5">
                    <textarea name="message"
                              class="form-control"
                              id="donate_message"
                              rows="4"
                              placeholder="Write message">{{ old('message') }}</textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <!-- Donor Personal Info End -->

        <!-- Form Button Start -->
        <div class="form-group-btn wow fadeInUp" data-wow-delay="1s">
            <button type="submit" class="btn-default">donate now</button>
            <div id="msgSubmit" class="h3 hidden"></div>
        </div>
        <!-- Form Button End -->
    </form>
</div>
<!-- Campaign Donation Form End -->
