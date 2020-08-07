@extends('layouts.waltcher')

@section('title')
    <title>{{ $machine->name }}</title>
@endsection

@section('description')
    <meta name="description" content="{{ $machine->meta_description ?? $machine->name }}">
@endsection

@section('body')
    <div class="wrapper">
        <div class="content content-gradient">
            <div class="equipment">
                <div class="equipment-single-block">
                    <div class="container text-spetifications">
                        <div class="row">
                            <div class="col-md-5 wow fadeIn img-equipment-spetifications">
                                <img src="{{ $machine->img }}" class="img-fluid" itemprop="image" alt="">
                                @if($machine->gallery && count($machine->gallery->images) > 0)
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <ul id="lightgalery" class="gallery">
                                                @foreach($machine->gallery->images as $image)
                                                    <li data-src="{{ $image }}"><img
                                                            src="{{ $image }}" class="img-fluid" alt="">
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-7">
                                <h1 class="text-center text-uppercase align-items-center">{{ $machine->name }}</h1>
                                <h2 class="equipment-spetifications">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Layer_1" x="0px" y="0px" width="512px" height="512px"
                                         viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
<path
    d="M348,327.195v-35.741l-32.436-11.912c-2.825-10.911-6.615-21.215-12.216-30.687l0.325-0.042l15.438-32.153l-25.2-25.269  l-32.118,15.299l-0.031,0.045c-9.472-5.601-19.758-9.156-30.671-11.978L219.186,162h-35.739l-11.913,32.759  c-10.913,2.821-21.213,6.774-30.685,12.379l-0.048-0.248l-32.149-15.399l-25.269,25.219l15.299,32.124l0.05,0.039  c-5.605,9.471-11.159,19.764-13.98,30.675L50,291.454v35.741l34.753,11.913c2.821,10.915,7.774,21.211,13.38,30.685l0.249,0.045  l-15.147,32.147l25.343,25.274l32.188-15.298l0.065-0.046c9.474,5.597,19.782,10.826,30.695,13.652L183.447,460h35.739  l11.915-34.432c10.913-2.826,21.209-7.614,30.681-13.215l0.05-0.175l32.151,15.192l25.267-25.326l-15.299-32.182l-0.046-0.061  c5.601-9.473,8.835-19.776,11.66-30.688L348,327.195z M201.318,368.891c-32.897,0-59.566-26.662-59.566-59.565  c0-32.896,26.669-59.568,59.566-59.568c32.901,0,59.566,26.672,59.566,59.568C260.884,342.229,234.219,368.891,201.318,368.891z"/>
                                        <path
                                            d="M462.238,111.24l-7.815-18.866l-20.23,1.012c-3.873-5.146-8.385-9.644-13.417-13.42l0.038-0.043l1.06-20.318l-18.859-7.822  L389.385,66.89l-0.008,0.031c-6.229-0.883-12.619-0.933-18.988-0.025L356.76,51.774l-18.867,7.815l1.055,20.32  c-5.152,3.873-9.627,8.422-13.403,13.46l-0.038-0.021l-20.317-1.045l-7.799,18.853l15.103,13.616l0.038,0.021  c-0.731,5.835-1.035,12.658-0.133,19.038l-15.208,13.662l7.812,18.87l20.414-1.086c3.868,5.144,8.472,9.613,13.495,13.385  l0.013,0.025l-1.03,20.312l20.668,7.815L374,201.703v-0.033c4,0.731,10.818,0.935,17.193,0.04l12.729,15.114l18.42-7.813  l-1.286-20.324c5.144-3.875,9.521-8.424,13.297-13.456l-0.023,0.011l20.287,1.047l7.802-18.864l-15.121-13.624l-0.033-0.019  c0.877-6.222,0.852-12.58-0.05-18.953L462.238,111.24z M392.912,165.741c-17.359,7.19-37.27-1.053-44.462-18.421  c-7.196-17.364,1.047-37.272,18.415-44.465c17.371-7.192,37.274,1.053,44.471,18.417  C418.523,138.643,410.276,158.547,392.912,165.741z"/>
</svg>
                                    Spetifications
                                </h2>
                                <div class="characteristics_group">
                                    @foreach($machine->properties as $property)
                                        <p>
                                            <span class="characteristic">{{ $property->name }}:</span>
                                            <span class="characteristic_value">{{ $property->pivot->value }}</span>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 text-equipment">
                                <h2 class="equipment-about">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;"
                                         xml:space="preserve">
            <g>
                <path d="M165,0C74.019,0,0,74.02,0,165.001C0,255.982,74.019,330,165,330s165-74.018,165-164.999C330,74.02,255.981,0,165,0z
		 M165,300c-74.44,0-135-60.56-135-134.999C30,90.562,90.56,30,165,30s135,60.562,135,135.001C300,239.44,239.439,300,165,300z"/>
                <path d="M164.998,70c-11.026,0-19.996,8.976-19.996,20.009c0,11.023,8.97,19.991,19.996,19.991
		c11.026,0,19.996-8.968,19.996-19.991C184.994,78.976,176.024,70,164.998,70z"/>
                <path
                    d="M165,140c-8.284,0-15,6.716-15,15v90c0,8.284,6.716,15,15,15c8.284,0,15-6.716,15-15v-90C180,146.716,173.284,140,165,140z"/>
            </g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g></svg>
                                    Features
                                </h2>
                                {!! $machine->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="form_btn btn-quotation js-form-open"><span>Get quotation</span></a>

        @can('admin')
            <a class="to-admin btn btn-warning"
               href="{{ route('admin.machines.edit', ['machine' => $machine->slug]) }}">
                Редактировать
            </a>
    @endcan

    @include('parts.form')

    @include('parts.recaptcha')

@endsection

