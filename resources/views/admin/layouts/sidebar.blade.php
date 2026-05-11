 <!-- Sidebar Start -->
 <aside class="left-sidebar">
   <!-- Sidebar scroll-->
   <div>
     <div class="brand-logo d-flex align-items-center justify-content-between">
       <a href="{{route('admin.dashboard')}}" class="text-nowrap logo-img">
         <img src="{{ asset(env('LOGO_PATH') )}}" class="dark-logo" width="150" alt="" />
         <img src="{{ asset(env('LOGO_PATH') )}}" class="light-logo" width="150" alt="" />
       </a>
       <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
         <i class="ti ti-x fs-8 text-muted"></i>
       </div>
     </div>
     <!-- Sidebar navigation-->
     <nav class="sidebar-nav scroll-sidebar" data-simplebar>
       <ul id="sidebarnav">
         <!-- =================== -->
         <!-- Dashboard -->
         <!-- =================== -->
         <li class="sidebar-item">
           <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
             <span>
               <i class="ti ti-aperture"></i>
             </span>
             <span class="hide-menu">Dashboard</span>
           </a>
         </li>

         <li class="sidebar-item">
           <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
             <span class="d-flex">
               <i class="ti ti-basket"></i>
             </span>
             <span class="hide-menu">Profession Management</span>
           </a>
           <ul aria-expanded="false" class="collapse first-level">
             <li class="sidebar-item">
               <a href="{{route('admin.professionList')}}" class="sidebar-link">
                 <div class="round-16 d-flex align-items-center justify-content-center">
                   <i class="ti ti-circle"></i>
                 </div>
                 <span class="hide-menu">Type of Nurse</span>
               </a>
             </li>
             <li class="sidebar-item">
               <a href="{{route('admin.specialityList')}}" class="sidebar-link">
                 <div class="round-16 d-flex align-items-center justify-content-center">
                   <i class="ti ti-circle"></i>
                 </div>
                 <span class="hide-menu">Speciality Job List</span>
               </a>
             </li>
           </ul>
         </li>

         {{-- <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-star"></i>
            </span>
            <span class="hide-menu">Speciality Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.specialityList')}}" class="sidebar-link">
         <div class="round-16 d-flex align-items-center justify-content-center">
           <i class="ti ti-circle"></i>
         </div>
         <span class="hide-menu">Speciality Job List</span>
         </a>
         </li>
       </ul>
       </li> --}}

       <li class="sidebar-item">
         <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
           <span class="d-flex">
             <i class="ti ti-package"></i>
           </span>
           <span class="hide-menu">Skill Management</span>
         </a>
         <ul aria-expanded="false" class="collapse first-level">
           <li class="sidebar-item">
             <a href="{{route('admin.skillList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Skill List</span>
             </a>
           </li>
         </ul>
       </li>

       <li class="sidebar-item">
         <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
           <span class="d-flex">
             <i class='fas fa-graduation-cap'></i>
           </span>
           <span class="hide-menu">Degree Management</span>
         </a>
         <ul aria-expanded="false" class="collapse first-level">
           <li class="sidebar-item">
             <a href="{{route('admin.degreeList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Degree List</span>
             </a>
           </li>
         </ul>
       </li>
       <li class="sidebar-item">
         <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
           <span class="d-flex">
             <i class="fa fa-certificate"></i>
           </span>
           <span class="hide-menu">Certificate Management</span>
         </a>
         <ul aria-expanded="false" class="collapse first-level">
           <li class="sidebar-item">
             <a href="{{route('admin.certificateList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Certificate List</span>
             </a>
           </li>
         </ul>
       </li>
       <li class="sidebar-item">
         <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
           <span class="d-flex">
             <i class='fas fa-user-graduate'></i>
           </span>
           <span class="hide-menu">Training Management</span>
         </a>
         <ul aria-expanded="false" class="collapse first-level">
           <li class="sidebar-item">
             <a href="{{route('admin.TrainingList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Training List</span>
             </a>
           </li>
         </ul>
       </li>
       <li class="sidebar-item">
         <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
           <span class="d-flex">
             <i class='fas fa-syringe'></i>
           </span>
           <span class="hide-menu">Vaccination Management</span>
         </a>
         <ul aria-expanded="false" class="collapse first-level">
           <li class="sidebar-item">
             <a href="{{route('admin.VaccinationList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Vaccination List</span>
             </a>
           </li>
           <li class="sidebar-item">
             <a href="{{route('admin.EvidenceList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Evidence List</span>
             </a>
           </li>
           <li class="sidebar-item">
             <a href="{{route('admin.imStatusList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Immunization Status List</span>
             </a>
           </li>
         </ul>
         <!-- <ul aria-expanded="false" class="collapse first-level">
           <li class="sidebar-item">
             <a href="{{route('admin.EvidenceList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Evidence List</span>
             </a>
           </li>
         </ul> -->
       </li>
       <li class="sidebar-item">
         <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
           <span class="d-flex">
             <i class="ti ti-building-store"></i>
           </span>
           <span class="hide-menu">Nurse Management</span>
         </a>
         <ul aria-expanded="false" class="collapse first-level">
           <li class="sidebar-item">
             <a href="{{route('admin.incoming-nurse-list')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Incoming Nurse List</span>
             </a>
           </li>
           <li class="sidebar-item">
             <a href="{{route('admin.unverified-nurse-list')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Unverified Nurse List</span>
             </a>
           </li>
           <li class="sidebar-item">
             <a href="{{route('admin.inprogess-nurse-nurse-list')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">In Progress Profile Nurse List</span>
             </a>
           </li>
           <li class="sidebar-item">
             <a href="{{route('admin.complete-nurse-nurse-list')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Completed Profile Nurse List</span>
             </a>
           </li>
           <li class="sidebar-item">
             <a href="{{route('admin.approved-nurse-list')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Approved Nurse list</span>
             </a>
           </li>
         </ul>
       </li>
       <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.healthcareList')}}" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-building-store"></i>
            </span>
            <span class="hide-menu">Healthcare Management</span>
          </a>
       </li>  
       <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.recruiter_list')}}" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-building-store"></i>
            </span>
            <span class="hide-menu">Recruiter List</span>
          </a>
       </li>  
       <li class="sidebar-item">
         <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
           <span class="d-flex">
             <i class="ti ti-building-store"></i>
           </span>
           <span class="hide-menu">Billing</span>
         </a>
         <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.plan_list')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Subscription Plan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{route('admin.show_customers')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Customers</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{route('admin.show_invoice')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Invoices</span>
              </a>
            </li>
         </ul>
        </li> 
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.add_compliance_security')}}" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-building-store"></i>
            </span>
            <span class="hide-menu">Compliance & Security</span>
          </a>
       </li>  
       <li class="sidebar-item">
         <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
           <span class="d-flex">
             <i class="ti ti-star"></i>
           </span>
           <span class="hide-menu">Verification Management</span>
         </a>
         <ul aria-expanded="false" class="collapse first-level">
           <li class="sidebar-item">
             <a href="{{route('admin.professionVerificationList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Profession Verification List</span>
             </a>
           </li>
           <li class="sidebar-item">
             <a href="{{route('admin.policeCheckVerificationList')}}" class="sidebar-link">
               <div class="round-16 d-flex align-items-center justify-content-center">
                 <i class="ti ti-circle"></i>
               </div>
               <span class="hide-menu">Police Check Verification List</span>
             </a>
           </li>

         </ul>
       </li>
       <li class="sidebar-item">
         <a class="sidebar-link" href="{{route('admin.traeductionList')}}" aria-expanded="false">
           <span>
             <i class="ti ti-seo-edit"></i>
           </span>
           <span class="hide-menu">Mandatory Training</span>
         </a>
       </li>
       <li class="sidebar-item">
        <a class="sidebar-link" href="#" aria-expanded="false">
          <span>
            <i class="ti ti-seo-edit"></i>
          </span>
          <span class="hide-menu">Professional Membership<br> Management</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
          <li class="sidebar-item">
            <a href="{{route('admin.organization_country_list')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Country List</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="{{route('admin.membershipType')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Membership Type</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="{{route('admin.awards_list')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Awards & Recognitions</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="#" aria-expanded="false">
          <span>
            <i class="ti ti-seo-edit"></i>
          </span>
          <span class="hide-menu">Language Skills Management</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
          <li class="sidebar-item">
            <a href="{{route('admin.language_list')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Language List</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="{{route('admin.certification_list')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Language Proficiency<br> Certifications</span>
            </a>
          </li>
          
        </ul>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="#" aria-expanded="false">
          <span>
            <i class="ti ti-seo-edit"></i>
          </span>
          <span class="hide-menu">Work Preferences &<br> Flexiblity Management</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
          <li class="sidebar-item">
            <a href="{{route('admin.work_preferences')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Work environment management</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="{{route('admin.position_list')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Position management</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="{{route('admin.work_shift_preferences')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Work-Life Balance & <br>Shift Preferences</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="{{route('admin.benefit_preferences')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Benefits Preferences</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="{{route('admin.employeement_type')}}" class="sidebar-link">
              <div class="round-16 d-flex align-items-center justify-content-center">
                <i class="ti ti-circle"></i>
              </div>
              <span class="hide-menu">Employment management</span>
            </a>
          </li>
        </ul>
      </li>
       <li class="sidebar-item">
         <a class="sidebar-link" href="{{route('admin.contact-list')}}" aria-expanded="false">
           <span>
             <i class="ti ti-aperture"></i>
           </span>
           <span class="hide-menu">Contact Us</span>
         </a>
       </li>
       <li class="sidebar-item">
            <a href="{{route('admin.jobList')}}" class="sidebar-link">
              <span>
                <i class="ti ti-aperture"></i>
              </span>
              <span class="hide-menu">Jobs List</span>
            </a>
          </li>
       <li class="sidebar-item">
         <a class="sidebar-link" href="{{route('admin.SeoList')}}" aria-expanded="false">
           <span>
             <i class="ti ti-seo-edit"></i>
           </span>
           <span class="hide-menu">Seo Management</span>
         </a>
       </li>
       </ul>

     </nav>
     <!-- End Sidebar navigation -->
   </div>
   <!-- End Sidebar scroll-->
 </aside>
 <!--  Sidebar End -->