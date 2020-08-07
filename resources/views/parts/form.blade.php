<div class="container-fluid form-equipment-block @if($errors->any()) form-equipment-block--active @endif">
    <div class="d-flex justify-content-center">
        <button type="button" class="fixed-backdrop-wrapper_close js-form-close"></button>
        <div class="row">
            <div class="col-md-12 text-equipment">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="col-md-4 logo-form">
                            <img src="{{ asset('assets/img/logo.webp') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                <h2 class="equipment-quotation">Get quotation</h2>
                <form action="{{ route('user.order', ['slug' => $machine->slug]) }}" method="post">
                    @csrf
                    @error('id')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <input class="form-equipment" type="text" placeholder="Name" name="name">
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <input class="form-equipment" type="text" placeholder="Company" name="company">
                    @error('company')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <input class="form-equipment" type="text" placeholder="Phone" name="phone">
                    @error('phone')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <input class="form-equipment" type="text" placeholder="E-mail" name="email">
                    @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <input type="hidden" value="{{ $machine->id }}" name="id">
                    <p class="order-form_wrapper">
                        <input type="checkbox" class="js-form-accept" checked> I agree to the processing of personal
                        data
                        <br>
                        <span>This site is protected by reCAPTCHA and the Google <a
                                href="https://policies.google.com/privacy">Privacy Policy</a> and <a
                                href="https://policies.google.com/terms">Terms of Service</a> apply.</span>
                    </p>
                    <button type="submit" class="form_btn btn-red js-button-neu">Send</button>
                </form>
            </div>
        </div>
    </div>
    @include('parts.recaptcha')
</div>
