@extends('layouts_enduser.index')

@section('content')

<main class="main" id="top">

    <section class="py-0">
        <div class="swiper theme-slider min-vh-100" data-swiper='{"loop":true,"allowTouchMove":false,"autoplay":{"delay":5000},"effect":"fade","speed":800}'>
          <div class="swiper-wrapper">
            <div class="swiper-slide" data-zanim-timeline="{}">
              <div class="bg-holder overlay overlay-freya" style="background-image:url(assets/img/header_1.jpg);" data-parallax="data-parallax" data-rellax-speed="-3"></div>
              <!--/.bg-holder-->
              <div class="container">
                <div class="row min-vh-100 justify-content-start align-items-end pt-11 pb-6 text-white" data-zanim-timeline="{}">
                  <div class="col">
                    <div class="row align-items-end">
                      <div class="col-lg">
                        <div class="overflow-hidden">
                          <p class="mb-1 text-uppercase ls" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.1}'>AvePoint Richmond</p>
                        </div>
                        <div class="overflow-hidden">
                          <h2 class="text-white fw-normal mb-4 mb-lg-0" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0}'>More livable spaces</h2>
                        </div>
                      </div>
                      <div class="col text-lg-end">
                        <div class="overflow-hidden">
                          <div data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.2}'><a class="btn btn-sm btn-outline-white" href="#!">View Case Study</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide" data-zanim-timeline="{}">
              <div class="bg-holder overlay overlay-freya" style="background-image:url(assets/img/header_2.jpg);" data-parallax="data-parallax" data-rellax-speed="-3"></div>
              <!--/.bg-holder-->
              <div class="container">
                <div class="row min-vh-100 justify-content-start align-items-end pt-11 pb-6 text-white" data-zanim-timeline="{}">
                  <div class="col">
                    <div class="row align-items-end">
                      <div class="col-lg">
                        <div class="overflow-hidden">
                          <p class="mb-1 text-uppercase ls" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.1}'>French Valley</p>
                        </div>
                        <div class="overflow-hidden">
                          <h2 class="text-white fw-normal mb-4 mb-lg-0" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0}'>Luxurious Apartment</h2>
                        </div>
                      </div>
                      <div class="col text-lg-end">
                        <div class="overflow-hidden">
                          <div data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.2}'><a class="btn btn-sm btn-outline-white" href="#!">More about Freya</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide" data-zanim-timeline="{}">
              <div class="bg-holder overlay overlay-freya" style="background-image:url(assets/img/header_3.jpg);" data-parallax="data-parallax" data-rellax-speed="-3"></div>
              <!--/.bg-holder-->
              <div class="container">
                <div class="row min-vh-100 justify-content-start align-items-end pt-11 pb-6 text-white" data-zanim-timeline="{}">
                  <div class="col">
                    <div class="row align-items-end">
                      <div class="col-lg">
                        <div class="overflow-hidden">
                          <p class="mb-1 text-uppercase ls" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.1}'>Upper Chesterfield</p>
                        </div>
                        <div class="overflow-hidden">
                          <h2 class="text-white fw-normal mb-4 mb-lg-0" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0}'>Sorption Marking Studio</h2>
                        </div>
                      </div>
                      <div class="col text-lg-end">
                        <div class="overflow-hidden">
                          <div data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.2}'><a class="btn btn-sm btn-outline-white" href="#!">More about Sorption</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-nav">
            <div class="swiper-button-prev"><span class="fas fa-chevron-left"></span></div>
            <div class="swiper-button-next"><span class="fas fa-chevron-right"></span></div>
          </div>
        </div>
    </section>

    <section class="bg-white text-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-10">
              <h3 class="mb-4">Indoraya Sentosa Acrylic Company is a leading manufacturer specializing in the production of acrylic sheets, acrylic accessories, and finished products made from acrylic materials</h3>
              <p>Acrylic manufacturer in Indonesia No. 1</p>
            </div>
          </div>
          <div class="row mt-6">
            <div class="col-lg-4">
              <div class="row align-items-center">
                <div class="col-md-6 col-lg-12"><img class="img-fluid" src="assets/img/img_1.jpg" alt="Residential" /></div>
                <div class="col-md-6 col-lg-12 text-md-start text-lg-center">
                  <h5 class="ls text-uppercase mt-4 mb-3">Unmatched Quality and Innovation</h5>
                  <p class="text-justify">We deliver high-quality products using state-of-the-art technology and continuously innovate to provide cutting-edge solutions.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
              <div class="row align-items-center">
                <div class="col-md-6 col-lg-12"><img class="img-fluid" src="assets/img/img_2.jpg" alt="Commercial" /></div>
                <div class="col-md-6 col-lg-12 text-md-start text-lg-center">
                  <h5 class="ls text-uppercase mt-4 mb-3">Expertise and Experience</h5>
                  <p class="text-justify">With years of industry experience, our skilled team can handle complex requirements and consistently deliver successful projects.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
              <div class="row align-items-center">
                <div class="col-md-6 col-lg-12"><img class="img-fluid" src="assets/img/img_3.jpg" alt="Hospitality" /></div>
                <div class="col-md-6 col-lg-12 text-md-start text-lg-center">
                  <h5 class="ls text-uppercase mt-4 mb-3">Customer-Centric Approach</h5>
                  <p class="text-justify">We prioritize our customers, offering personalized service and tailored solutions to ensure a smooth and satisfying experience.</p>
                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->
    </section>

    <section class="py-10 overflow-hidden text-center" data-zanim-timeline="{}" data-zanim-trigger="scroll">
        <div class="bg-holder overlay overlay-1" style="background-image:url(assets/img/banner_3.jpg);" data-parallax="data-parallax" data-rellax-percentage="0.5"></div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="overflow-hidden">
            <h1 class="fs-5 fs-sm-6 text-white mb-3" data-zanim-xs='{"delay":0}'>Top Product</h1>
          </div>
          <div class="overflow-hidden">
            <h4 class="ls fw-light text-uppercase text-300 mb-0" data-zanim-xs='{"delay":0.1}'>Indonesia</h4>
          </div>
        </div><!-- end of .container-->
    </section>

    <section class="text-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
              <h3 class="mb-4">Top Product's</h3>
              <p class="mb-7">Our company is supported by advanced machinery and skilled human resources to apply and integrate all acrylic product needs, both small and large. See the latest examples of our best products.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 mb-4"><img class="w-100" src="../enduser/assets/img/1.jpg" alt="gallery image"></div>
            <div class="col-lg-6 mb-4"><img class="w-100" src="../enduser/assets/img/2.jpg" alt="gallery image"></div>
            <div class="col-lg-6 mb-4"><img class="w-100" src="../enduser/assets/img/3.jpg" alt="gallery image"></div>
            <div class="col-lg-6 mb-4"><img class="w-100" style="height: 718px;" src="../enduser/assets/img/4.jpg" alt="gallery image"></div>
          </div>
        </div><!-- end of .container-->
    </section>

</main>

@endsection