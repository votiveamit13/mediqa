@extends('nurse.layouts.layout')
@section('content')

<main class="main">
      <section class="section-box-2">
        <div class="container">
          <div class="banner-hero banner-single banner-single-bg">
            <div class="block-banner text-center">
              <h3 class="wow animate__animated animate__fadeInUp"><span class="color-brand-2">22 Jobs</span> Available Now</h3>
              <div class="font-sm color-text-paragraph-2 mt-10 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, <br class="d-none d-xl-block">atque delectus molestias quis?</div>
              <div class="form-find text-start mt-40 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <form>
                  <div class="box-industry">
                    <select class="form-input mr-10 select-active input-industry">
                      <option value="0">Casual Shifts</option>
                      <option value="1">Term Contracts</option>
                    </select>
                  </div>
                  <select class="form-input mr-10 select-active">
                    <option value="">Location</option>
                    <option value="AX">Aland Islands</option>
                    <option value="AF">Afghanistan</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                  </select>
                  <input class="form-input input-keysearch mr-10" type="date" placeholder="29 jan - 4 feb">
                  <button class="btn btn-default btn-find font-sm">Search</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box mt-30">
        <div class="container">
          <div class="row flex-row-reverse">
            <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
              <div class="content-page">
                <div class="box-filters-job">
                  <div class="row">
                    <div class="col-xl-6 col-lg-5"><span class="text-small text-showing">Showing <strong>41-60 </strong>of <strong>944 </strong>jobs</span></div>
                    <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                      <div class="display-flex2">
                        <div class="box-border mr-10"><span class="text-sortby">Show:</span>
                          <div class="dropdown dropdown-sort">
                            <button class="btn dropdown-toggle" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>12</span><i class="fi-rr-angle-small-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
                              <li><a class="dropdown-item active" href="#">10</a></li>
                              <li><a class="dropdown-item" href="#">12</a></li>
                              <li><a class="dropdown-item" href="#">20</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="box-border"><span class="text-sortby">Sort by:</span>
                          <div class="dropdown dropdown-sort">
                            <button class="btn dropdown-toggle" id="dropdownSort2" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>Newest Post</span><i class="fi-rr-angle-small-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2">
                              <li><a class="dropdown-item active" href="#">Newest Post</a></li>
                              <li><a class="dropdown-item" href="#">Oldest Post</a></li>
                              <li><a class="dropdown-item" href="#">Rating Post</a></li>
                            </ul>
                          </div>
                        </div>
                        <!-- <div class="box-view-type"><a class='view-type' href='#'><img src="assets/imgs/template/icons/icon-list.svg" alt="jobBox"></a><a class='view-type' href='#'><img src="assets/imgs/template/icons/icon-grid-hover.svg" alt="jobBox"></a></div> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-1.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Fulltime</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$500</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-2.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Part time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$800</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-3.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-4.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                       
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-5.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Fulltime</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$500</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-6.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Part time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$800</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-7.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-8.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                       
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-1.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Fulltime</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$500</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-2.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Part time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                       
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$800</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-3.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                       
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-4.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-5.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Fulltime</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$500</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-6.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Part time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                       
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$800</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-7.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Products Manager</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-8.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Lead Quality Control QA</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Full time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$250</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-1.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Fulltime</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
                        
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$500</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card-grid-2 hover-up">
                      <div class="card-grid-2-image-left"><span class="flash"></span>
                        <div class="image-box"><img src="assets/imgs/brands/brand-2.png" alt="jobBox"></div>
                        <div class="right-info"><a class='name-job' href='job-details.php'>St George Hospital</a><span class="location-small">New York, US</span></div>
                      </div>
                      <div class="card-block-info">
                        <h6><a href='job-details.html'>Gen Med/Gen Surg Ward</a></h6>
                        <div class="mt-5"><span class="card-briefcase">Part time</span><span class="card-time">7:00 AM - 5:30 PM</span></div>
                        <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur.</p>
                       
                        <div class="card-2-bottom mt-30">
                          <div class="row">
                            <div class="col-lg-7 col-7"><span class="card-text-price">$800</span><span class="text-muted">/Hour</span></div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="paginations">
                <ul class="pager">
                  <li><a class="pager-prev" href="#"></a></li>
                  <li><a class="pager-number" href="#">1</a></li>
                  <li><a class="pager-number" href="#">2</a></li>
                  <li><a class="pager-number" href="#">3</a></li>
                  <li><a class="pager-number" href="#">4</a></li>
                  <li><a class="pager-number" href="#">5</a></li>
                  <li><a class="pager-number active" href="#">6</a></li>
                  <li><a class="pager-number" href="#">7</a></li>
                  <li><a class="pager-next" href="#"></a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-12">
              <div class="sidebar-shadow none-shadow mb-30">
                <div class="sidebar-filters">
                  <div class="filter-block head-border mb-30">
                    <h5>Advance Filter <a class="link-reset" href="#">Reset</a></h5>
                  </div>
                  <!-- <div class="filter-block mb-30">
                    <div class="form-group select-style select-style-icon">
                      <select class="form-control form-icons select-active">
                        <option>New York, US</option>
                        <option>London</option>
                        <option>Paris</option>
                        <option>Berlin</option>
                      </select><i class="fi-rr-marker"></i>
                    </div>
                  </div> -->
                  <div class="filter-block mb-20">
                    <h5 class="medium-heading mb-15">Speciality</h5>
                    <div class="form-group">
                      <ul class="list-checkbox">
                        <li>
                          <label class="cb-container">
                            <input type="checkbox" checked="checked"><span class="text-small">Any speciality</span><span class="checkmark"></span>
                          </label><span class="number-item">18</span>
                        </li>
                        <li>
                          <label class="cb-container">
                            <input type="checkbox"><span class="text-small">ICU</span><span class="checkmark"></span>
                          </label><span class="number-item">12</span>
                        </li>
                        <li>
                          <label class="cb-container">
                            <input type="checkbox"><span class="text-small">Gastro</span><span class="checkmark"></span>
                          </label><span class="number-item">23</span>
                        </li>
                        <li>
                          <label class="cb-container">
                            <input type="checkbox"><span class="text-small">Cardio</span><span class="checkmark"></span>
                          </label><span class="number-item">43</span>
                        </li>
                        <li>
                          <label class="cb-container">
                            <input type="checkbox"><span class="text-small">Gen med</span><span class="checkmark"></span>
                          </label><span class="number-item">65</span>
                        </li>
                        <li>
                          <a href="#" class="text-link-bd-btom hover-up" style="text-decoration: underline !important;">Show All</a>
                        </li>
                      </ul>
                    </div>
                  </div>


                  <div class="filter-block mb-20">
                    <h5 class="medium-heading mb-15">Time</h5>
                    <div class="form-group">
                      <ul class="list-checkbox">
                        <li>
                          <label class="cb-container">
                            <input type="checkbox" checked="checked"><span class="text-small">Morning</span><span class="checkmark"></span>
                          </label><span class="number-item">18</span>
                        </li>
                        <li>
                          <label class="cb-container">
                            <input type="checkbox"><span class="text-small">Afternoon</span><span class="checkmark"></span>
                          </label><span class="number-item">12</span>
                        </li>
                        <li>
                          <label class="cb-container">
                            <input type="checkbox"><span class="text-small">Night</span><span class="checkmark"></span>
                          </label><span class="number-item">23</span>
                        </li>
                      </ul>
                    </div>
                  </div>



                  <div class="filter-block mb-20">
                    <h5 class="medium-heading mb-25">Shift length (2 to 12 hrs)</h5>
                    <div class="list-checkbox pb-20">
                      <div class="row position-relative mt-10 mb-20">
                        <div class="col-sm-12 box-slider-range">
                          <div id="slider-range"></div>
                        </div>
                        <div class="box-input-money">
                          <!-- <input class="input-disabled form-control min-value-money" type="text" name="min-value-money" disabled="disabled" value=""> -->
                          <!-- <input class="form-control min-value" type="hidden" name="min-value" value=""> -->
                        </div>
                      </div>
                      <div class="box-number-money">
                        <div class="row mt-30">
                          <div class="col-sm-6 col-6"><span class="font-sm color-brand-1">2 hrs</span></div>
                          <div class="col-sm-6 col-6 text-end"><span class="font-sm color-brand-1">12 hrs</span></div>
                        </div>
                      </div>
                    </div>
                  </div>



                  <div class="filter-block mb-20">
                    <h5 class="medium-heading mb-25">Distance within (5000km)</h5>
                    <div class="list-checkbox pb-20">
                      <div class="row position-relative mt-10 mb-20">
                        <div class="col-sm-12 box-slider-range">
                          <div id="slider-range-2"></div>
                        </div>
                        <div class="box-input-money">
                          <!-- <input class="input-disabled form-control min-value-money" type="text" name="min-value-money" disabled="disabled" value=""> -->
                          <!-- <input class="form-control min-value" type="hidden" name="min-value" value=""> -->
                        </div>
                      </div>
                     <!--  <div class="box-number-money">
                        <div class="row mt-30">
                          <div class="col-sm-6 col-6"><span class="font-sm color-brand-1">2 hrs</span></div>
                          <div class="col-sm-6 col-6 text-end"><span class="font-sm color-brand-1">12 hrs</span></div>
                        </div>
                      </div> -->
                    </div>
                  </div>





                  <div class="filter-block mb-30">
                    <h5 class="medium-heading mb-10">Hospitals</h5>
                    <div class="form-group">
                      <ul class="list-checkbox">
                        <li>
                          <label class="cb-container">
                            <input type="checkbox" checked="checked"><span class="text-small">Any hospitals</span><span class="checkmark"></span>
                          </label><span class="number-item">70</span>
                        </li>
                        <li>
                          <label class="cb-container">
                            <input type="checkbox"><span class="text-small">Hospitals 1</span><span class="checkmark"></span>
                          </label><span class="number-item">45</span>
                        </li>
                        <li>
                          <label class="cb-container">
                            <input type="checkbox"><span class="text-small">Hospitals 2</span><span class="checkmark"></span>
                          </label><span class="number-item">57</span>
                        </li>

                        <li>
                          <a href="#" class="text-link-bd-btom hover-up" style="text-decoration: underline !important;">Show All</a>
                        </li>
                        
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

        {{-- City Selection Modal --}}
        @if (Auth::guard('nurse_middle')->user()->active_country == null )
        <div class="modal fade" id="registrationCountryModal"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">

              <!-- Success Icon -->
              <div class="modal-header border-0 justify-content-center">
                <div class="rounded-circle bg-success-subtle p-3">
                  <i class="bi bi-check-circle-fill text-success fs-1"></i>
                </div>
              </div>

              
              <div class="modal-header border-0"> 
                <h5 class="modal-title fw-bold w-100"> Please choose your registration country </h5> 
              </div>
              <!-- Title -->


              <!-- Dropdown -->
              <div class="modal-body">
                <p class="mb-3"> 
                  This sets your search country and loads the right jurisdictions and checks. You can add more countries later and switch anytime. 
                </p>
                <select class="form-select" id="registration_country">
                  <option value="">Select Country</option>
                  @foreach($countries as $country)
                    <option value="{{ $country->iso2 }}" @if($country->iso2 === 'AU') selected @endif data-id="{{ $country->id }}">{{ $country->name }}</option>
                  @endforeach
                </select>
                  <input type="hidden" name="country_id" id="country_id">
                <span class="text-danger d-block mt-2" id="countryError"></span>
              </div>

              <!-- Button -->
              <div class="modal-footer border-0">
                <button class="btn btn-dark w-100 fw-bold" id="saveCountry">
                  Continue
                </button>
              </div>

            </div>
          </div>
        </div>
      @endif


@endsection
@section('js')
<script>
  $(document).ready(function () {
      if (window.location.pathname.includes("/nurse/dashboard")) {
          $('#registrationCountryModal').modal('show');
      }

  });

  $('#registration_country').on('change', function() { 
    let selectedId = $(this).find(':selected').data('id'); 
    $('#country_id').val(selectedId); 
  });

  $('#saveCountry').on('click', function () {

      const country = $('#registration_country').val();
      const country_code = $('#country_id').val();

      if (!country) {
          $('#countryError').text('Please select a country');
          return;
      }


      $.ajax({
          url: "{{ route('nurse.saveRegistrationCountry') }}",
          type: "POST",
          data: {
              country_id: country,
              country_code: country_code,
              _token: "{{ csrf_token() }}"
          },
          success: function () {
              $('#registrationCountryModal').modal('hide');

              // Unlock UI
              $('.profession-tab').removeClass('disabled');

              // Redirect cleanly
              // window.location.href = "{{ route('nurse.my-profile') }}?page=my_profile";
              window.location.href = "{{ route('nurse.dashboard') }}";
          }
      });
  });
</script>
@endsection