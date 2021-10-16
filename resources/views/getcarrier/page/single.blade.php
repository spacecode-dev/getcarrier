@include('getcarrier.templates.slot')
@extends('getcarrier.index')
@section('content')
    <section class="section banner">
        <div class="bg"></div>
        <div class="container is-widescreen">
            <div class="columns mb-6">
                <div class="column is-6">
                    <div>
                        <h1 class="has-text-white">Get Instant <b>Car Shipping Quotes & Compare Rates</b></h1>
                        <ul class="has-text-white">
                            <li>No Upfront Fees</li>
                            <li>All Drivers are Insured and Bonded</li>
                            <li>24/7 Customer Support</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="images">
                        <div>
                            <img src="{{ url('storage/website/banner/image_1.png') }}" alt=""/>
                            <img src="{{ url('storage/website/banner/image_2.png') }}" alt=""/>
                            <img src="{{ url('storage/website/banner/image_3.png') }}" alt=""/>
                            <img src="{{ url('storage/website/banner/image_4.png') }}" alt=""/>
                            <img src="{{ url('storage/website/banner/image_5.png') }}" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img class="truck" src="{{ url('storage/website/truck.png') }}" alt=""/>
        <div class="div-to-bottom">
            <button class="to-bottom">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>
        <div class="corner-bg"></div>
    </section>
    <section class="section details">
        <div class="container is-widescreen">
            <div class="columns mb-6">
                <div class="column has-text-centered">
                    <h2>What Details <b>Do I Need to Get a Quote?</b></h2>
                    <p class="subtitle">Here are some of the reasons why you should get a car shipping quote from GetCarrier</p>
                </div>
            </div>
            <div class="columns is-gapless start mb-0">
                <div class="column is-4">
                    <div class="card">
                        <div class="image">
                            <img src="{{ url('storage/website/details/eco-car.png') }}" alt=""/>
                        </div>
                        <div class="text">
                            <h3 class="has-text-weight-bold">Hands-On Approach</h3>
                            <p class="mt-3">Our technicians will monitor your vehicle from when we pick it up to when it is dropped off. We also provide updates for you every step of the way.</p>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="card">
                        <div class="image">
                            <img src="{{ url('storage/website/details/kilometer.png') }}" alt=""/>
                        </div>
                        <div class="text">
                            <h3 class="has-text-weight-bold">No Upfront Payments</h3>
                            <p class="mt-3">Ship your car with us without having to make a deposit. We will issue a quote upon pickup, which is only due upon delivery. No out-of-pocket costs until your car arrives at its
                                destination, safe and sound.</p>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="card">
                        <div class="image">
                            <img src="{{ url('storage/website/details/shield.png') }}" alt=""/>
                        </div>
                        <div class="text">
                            <h3 class="has-text-weight-bold">Licensed and Insured</h3>
                            <p class="mt-3">Ship your vehicle with confidence and the protection of a $250,000 insurance policy. This policy takes effect as soon as your car is in our hands. Best of all, there is no
                                deductible.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns end is-gapless">
                <div class="column is-4">
                    <div class="dot">
                        <div class="red-dot"></div>
                    </div>
                    <div class="card">
                        <div class="image">
                            <img src="{{ url('storage/website/details/team.png') }}" alt=""/>
                        </div>
                        <div class="text">
                            <h3 class="has-text-weight-bold">Qualified Professionals</h3>
                            <p class="mt-3">At GetCarrier, we ship about 3,000 cars per month, so you can trust our experience and expertise. Even with such high volumes, we treat each vehicle as our own.</p>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="dot">
                        <div class="red-dot"></div>
                    </div>
                    <div class="card">
                        <div class="image">
                            <img src="{{ url('storage/website/details/task-list.png') }}" alt=""/>
                        </div>
                        <div class="text">
                            <h3 class="has-text-weight-bold">Full Inspection</h3>
                            <p class="mt-3">Before shipping your vehicle, we’ll do a full-scale inspection to verify its condition. We do this at the end as well to protect you from any damage that could occur in
                                transit.</p>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="dot">
                        <div class="red-dot"></div>
                    </div>
                    <div class="card">
                        <div class="image">
                            <img src="{{ url('storage/website/details/help.png') }}" alt=""/>
                        </div>
                        <div class="text">
                            <h3 class="has-text-weight-bold">Need Help?</h3>
                            <ul class="mt-3">
                                <li><a href="#">How do I save on car insurance?</a></li>
                                <li><a href="#">Can I drive someone else’s car?</a></li>
                                <li><a href="#">More expert guides</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section quote">
        <div class="container is-widescreen">
            <div class="columns mb-6">
                <div class="column has-text-centered">
                    <h2>Ready to <b>Get a Quote?</b></h2>
                </div>
            </div>
            <div class="columns is-gapless">
                <div class="column is-6">
                    <div class="image car">
                        <img src="{{ url('storage/website/quote/car.png') }}" alt=""/>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="card">
                        <h3 class="has-text-weight-bold is-size-3">Set up the ZlPs</h3>
                        <p class="mt-3">We need to know the ZIPS to and from delivery address to show you offers</p>
                    </div>
                </div>
            </div>
            <div class="columns reverse is-gapless">
                <div class="column is-6">
                    <div class="image monitor">
                        <div class="before"></div>
                        <img src="{{ url('storage/website/quote/monitor.png') }}" alt=""/>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="card">
                        <h3 class="has-text-weight-bold is-size-3">Choose the Car <br/>and Dates</h3>
                        <p class="mt-3">Choose your car model and dates you would like the car to be shipped</p>
                    </div>
                </div>
            </div>
            <div class="columns is-gapless mb-0">
                <div class="column is-6">
                    <div class="image truck">
                        <img src="{{ url('storage/website/quote/truck.png') }}" alt=""/>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="card">
                        <h3 class="has-text-weight-bold is-size-3">Get a Quote from <br/>TOP Companies</h3>
                        <p class="mt-3">Now you will get an access to choose the quote you are interested in <br/><br/>*no commitments from your side</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section cta">
        <div class="container is-widescreen">
            <div class="columns is-gapless">
                <div class="column is-flex is-flex-direction-row is-justify-content-space-between is-align-items-center">
                    <h2 class="has-text-white is-size-3">Now I am Ready! <b>What`s Next?</b></h2>
                    <button class="button is-white is-rounded is-medium">Get my quote</button>
                </div>
            </div>
        </div>
    </section>
    <section class="section carousel">
        <div class="container is-widescreen">
            <div class="columns mb-6">
                <div class="column has-text-centered">
                    <h2>What <b>Customers Say</b></h2>
                </div>
            </div>
            <div class="owl-carousel owl-theme" data-carousel="{items: 3, loop: false, dots: false, nav: true, margin: 30, autoWidth: true, autoplay: false, smartSpeed: 500}">
                <div class="item">
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="logo">
                                <img src="{{ url('storage/website/facebook.png') }}" alt=""/>
                            </div>
                            <div class="author">
                                <h5>David A.</h5>
                                <div class="recommend">
                                    <p>Recommend: <span class="has-text-success is-uppercase"><b>YES</b></span></p>
                                </div>
                            </div>
                            <div class="date">07.12.20</div>
                        </div>
                        <div class="card-content">
                            <p>Now you will get an access to choose the quote you are interested in no commitments from your side. Now you will get an access to choose the quote you are interested in no commitments from
                                your side...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section shipping">
        <div class="bg"></div>
        <div class="container is-widescreen">
            <div class="columns is-variable is-8">
                <div class="column is-6">
                    <h2 class="has-text-white mb-5">What Are Car <br/><b>Shipping Quotes?</b></h2>
                    <p>At GetCarrier, we understand that you may want to shop around before shipping your vehicle. Car shipping quotes will give you an estimate of how much it will cost to transport your car from one
                        place to the next. These estimates will factor multiple details into the price, including the distance, shipping type (i.e., open carrier or enclosed), speed and the vehicle's current
                        condition.</p>
                    <hr/>
                    <blockquote class="is-size-4 mb-4"><b>Why are Car Transport Quotes so Useful?</b></blockquote>
                    <p>Since you want to get the best service and pricing, it helps to get quotes from multiple carriers. When obtaining car shipping quotes, be sure to get an itemized list of charges so that you know
                        what is (and isn’t) included. We also recommend checking the company’s online reviews and ratings from previous customers.</p>
                </div>
            </div>
        </div>
        <img class="truck" src="{{ url('storage/website/truck.png') }}" alt=""/>
        <img class="man" src="{{ url('storage/website/man.jpg') }}" alt="">
        <div class="corner-bg"></div>
    </section>
    <section class="section types">
        <div class="container is-widescreen">
            <div class="columns mb-6">
                <div class="column has-text-centered">
                    <h2>What Types of <b>Car Shipping Are There?</b></h2>
                    <p class="subtitle">We compare dozers of the biggest insurance providers in the country, including</p>
                </div>
            </div>
            <div class="columns block is-gapless">
                <div class="column is-4">
                    <div class="card">
                        <img class="mb-5" src="{{ url('storage/website/types/speech-bubble.png') }}" alt=""/>
                        <h3 class="has-text-weight-bold is-size-4">What Types of Car Shipping are There?</h3>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="card">
                        <img class="mb-5" src="{{ url('storage/website/types/truck.png') }}" alt=""/>
                        <h3 class="has-text-weight-bold is-size-4">Enclosed car transport</h3>
                    </div>
                    <div class="help">
                        <h3 class="has-text-weight-bold is-size-4 mb-3 has-text-white">Enclosed car transport</h3>
                        <p class="has-text-white">This method is ideal for classic cars or high-end vehicles. Our enclosed trailers will protect the vehicle from the elements so that there is not a scratch on it when it
                            arrives. Our drivers
                            are licensed professionals, and all cars are insured from pickup to drop-off with our $250,000, $0 deductible policy.</p>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="card">
                        <img class="mb-5" src="{{ url('storage/website/types/truck.png') }}" alt=""/>
                        <h3 class="has-text-weight-bold is-size-4">Open Car Shipping</h3>
                    </div>
                </div>
            </div>
            <div class="columns block is-gapless">
                <div class="column is-4">
                    <div class="card">
                        <img class="mb-5" src="{{ url('storage/website/types/man.png') }}" alt=""/>
                        <h3 class="has-text-weight-bold is-size-4">Door to Door Transport</h3>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="card">
                        <img class="mb-5" src="{{ url('storage/website/types/watch.png') }}" alt=""/>
                        <h3 class="has-text-weight-bold is-size-4">Expedited Car Shipping</h3>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="card">
                        <img class="mb-5" src="{{ url('storage/website/types/repair.png') }}" alt=""/>
                        <h3 class="has-text-weight-bold is-size-4">Inoperable Car Transport</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="corner-bg"></div>
        <div class="corner-grey-bg"></div>
    </section>
    <section class="section calculate">
        <div class="container is-widescreen">
            <div class="columns mb-6">
                <div class="column has-text-centered">
                    <h2>How to Calculate Your <b>Car Shipping Quote</b></h2>
                    <p class="subtitle side-bordered">How much does car shipping cost?</p>
                </div>
            </div>
            <div class="columns is-variable mb-6 is-8">
                <div class="column is-6">
                    <p>Before making a final decision on how to transport your vehicle, it helps to know the variables involved in the total cost. When working with us, we’ll discuss these details with you so that you
                        understand what goes into transporting your vehicle. Here are the various factors we consider: <br/><br/>Don't disregard to visit <br/>
                        <a href="#" class="has-text-black"><b>https://www.transportreviews.com/Company/GetCarriercom</b></a> to get a better
                        idea about our company and reviews. Count your price here, use Live Chat, or call</p>
                    <p class="has-text-black phone is-flex is-align-items-center is-flex-direction-row">
                        <img src="{{ url('storage/website/phone.png') }}" class="mr-2" alt="">
                        <b>(866) 494—1477</b>
                    </p>
                    <hr/>
                    <p class="has-text-black"><b>More about how much does it cost to ship a car <a href="#" class="has-text-black">https://getcarrier.com/blog/car-shipping-cost</a></b></p>
                    <button class="button is-white is-rounded is-medium">More about your car article from car moving companies</button>
                </div>
                <div class="column is-6">
                    <img src="{{ url('storage/website/truck-d.png') }}" alt=""/>
                </div>
            </div>
            <div class="columns block is-gapless">
                <div class="column is-3">
                    <div class="card">
                        <img class="mb-3" src="{{ url('storage/website/calculate/distance.png') }}" alt=""/>
                        <h3 class="mb-2"><b>Distance</b></h3>
                        <p>One of the elemental car transport costs is the distance from pickup and drop-off. Like other car shipping companies, we charge a per-mile rate. This cost is added to everything else to
                            determine your total quote. Typically, the per-mile rate is lower for longer distances.</p>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="card">
                        <img class="mb-3" src="{{ url('storage/website/calculate/frame.png') }}" alt=""/>
                        <h3 class="mb-2"><b>Car condition</b></h3>
                        <p>Even if your vehicle is inoperable, it may not cost extra to transport it. As long as we can move it without additional equipment, the charge will be the same as if the car was driveable. In
                            cases where a winch or tow truck is necessary, you will have to pay extra.</p>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="card">
                        <img class="mb-3" src="{{ url('storage/website/calculate/group.png') }}" alt=""/>
                        <h3 class="mb-2"><b>Time of the year</b></h3>
                        <p>As weather conditions shift throughout the year, they can incur higher costs. For example, during the winter months, our drivers may have to travel through snowy and icy conditions. We also charge extra for holiday travel (i.e., Christmas, New Year’s, Thanksgiving), so plan accordingly.</p>
                    </div>
                </div>
                <div class="column last is-3">
                    <div class="card">
                        <img class="mb-3" src="{{ url('storage/website/calculate/trailer.png') }}" alt=""/>
                        <h3 class="mb-2"><b>Type of trailer</b></h3>
                        <p>If you ship your car in an open-air trailer, you will pay much less than you would for an enclosed unit. This is because we can fit more vehicles on open trailers, and they are easier to move on and off. Be aware that expedited shipping may require an enclosed trailer, which can inflate your total estimate even further.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop
