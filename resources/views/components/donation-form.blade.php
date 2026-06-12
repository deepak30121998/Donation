@props([
    'causes' => null,
])

@php
    $amountsSection = $sections->get('global.donation_amounts') ?? null;
    $rawAmounts = $amountsSection?->body
        ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($amountsSection->body)))))
        : ['100', '200', '300', '400', '500', '600'];
    $defaultAmount = (string) ($rawAmounts[0] ?? '100');
@endphp

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
                @foreach($rawAmounts as $i => $amt)
                    <div class="donate-value">
                        <input type="radio" id="value{{ $i + 1 }}" name="amount" value="{{ $amt }}"
                               {{ old('amount', $defaultAmount) === $amt ? 'checked' : '' }}>
                        <label for="value{{ $i + 1 }}">$ {{ number_format((float)$amt, 2) }}</label>
                    </div>
                @endforeach
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
