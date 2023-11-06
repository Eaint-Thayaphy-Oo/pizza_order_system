@extends('user.layouts.master')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    @if (session('messageContact'))
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('messageContact') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('user#contactPage') }}" method="post" name="sentMessage" id="contactForm"
                        novalidate="novalidate">
                        @csrf
                        <div class="control-group">
                            <input type="text" class="form-control @error('contactName') is-invalid @enderror"
                                name="contactName" id="name" placeholder="Your Name" />
                            <p class="help-block text-danger"></p>
                            @error('contactName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control @error('contactEmail') is-invalid @enderror"
                                name="contactEmail" id="email" placeholder="Your Email" />
                            <p class="help-block text-danger"></p>
                            @error('contactEmail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="control-group">
                            <textarea class="form-control @error('contactMessage') is-invalid @enderror" rows="8" name="contactMessage" id="message"
                                placeholder="Message"></textarea>
                            <p class="help-block text-danger"></p>
                            @error('contactMessage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" name="sendMessageButton"
                                id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15445263.817452364!2d96.68303!3d19.07181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2smm!4v1699240524780!5m2!1sen!2smm"
                        width="620" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
