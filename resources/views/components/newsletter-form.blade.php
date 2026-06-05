<!-- Newsletter Form Start -->
<div class="newsletter-form">
    <form id="newsletterForm" action="{{ route('newsletter.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email"
                   name="email"
                   class="form-control"
                   id="newsletter-email"
                   placeholder="Enter Your Email"
                   value="{{ old('email') }}"
                   required>
            <button type="submit" class="newsletter-btn">
                <i class="fa-regular fa-paper-plane"></i>
            </button>
        </div>
        @error('email')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </form>
</div>
<!-- Newsletter Form End -->
