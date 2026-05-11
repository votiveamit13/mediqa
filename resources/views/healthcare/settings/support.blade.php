@extends('nurse.layouts.layout')

@section('css')
<style>
    .quill_rendered_content {
        position: relative;
        z-index: 2;
        color: #000;
        font-family: inherit;
    }

    /* Reset block elements */
    .quill_rendered_content p,
    .quill_rendered_content h1,
    .quill_rendered_content h2,
    .quill_rendered_content h3,
    .quill_rendered_content h4,
    .quill_rendered_content h5,
    .quill_rendered_content h6,
    .quill_rendered_content ul,
    .quill_rendered_content ol,
    .quill_rendered_content li {
        display: block !important;
        position: relative !important;
        float: none !important;
        clear: both !important;
        width: 100% !important;
        overflow: visible !important;
        height: auto !important;
        max-height: none !important;
        min-height: auto !important;
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        text-align: left !important;
    }

    /* Headings */
    .quill_rendered_content h1,
    .quill_rendered_content h2,
    .quill_rendered_content h3,
    .quill_rendered_content h4,
    .quill_rendered_content h5,
    .quill_rendered_content h6 {
        margin: 25px 0 15px !important;
        padding: 0 !important;
        font-weight: 700 !important;
        line-height: 1.3 !important;
        color: #000 !important;
    }

    .quill_rendered_content h3 {
        font-size: 28px !important;
    }

    /* Paragraphs */
    .quill_rendered_content p {
        margin: 0 0 16px !important;
        padding: 0 !important;
        font-size: 18px !important;
        
        color: #000 !important;
    }

    /* UL bullet list */
    .quill_rendered_content ul {
        list-style-type: disc !important;
        padding-left: 25px !important;
        
    }

    .quill_rendered_content ul li {
        display: list-item !important;
        padding: 0 !important;
        margin: 0 0 12px !important;
        font-size: 18px !important;
        line-height: 1.8 !important;
        color: #000 !important;
        white-space: normal !important;
        list-style-type: disc !important;
    }

    /* Remove old custom ticks */
    .quill_rendered_content ul li::before {
        content: none !important;
    }

    /* Ordered list */
    .quill_rendered_content ol {
        list-style-type: decimal !important;
        padding-left: 25px !important;
        margin: 0 0 20px 0 !important;
    }

    .quill_rendered_content ol li {
        display: list-item !important;
        padding: 0 !important;
        margin: 0 0 12px !important;
        font-size: 18px !important;
        line-height: 1.8 !important;
        color: #000 !important;
        list-style-type: decimal !important;
    }

    .quill_rendered_content ol li::before {
        content: none !important;
    }

    /* Inline formatting */
    .quill_rendered_content strong {
        font-weight: 700 !important;
    }

    .quill_rendered_content em {
        font-style: italic !important;
    }

    .quill_rendered_content a {
        color: #0d6efd !important;
        text-decoration: underline !important;
    }

    /* Quill alignment */
    .quill_rendered_content .ql-align-center {
        text-align: center !important;
    }

    .quill_rendered_content .ql-align-right {
        text-align: right !important;
    }

    .quill_rendered_content .ql-align-justify {
        text-align: justify !important;
    }

    @media (max-width: 768px) {
        .quill_rendered_content h3 {
            font-size: 24px !important;
        }

        .quill_rendered_content p,
        .quill_rendered_content ul li,
        .quill_rendered_content ol li {
            font-size: 16px !important;
        }
    }
</style>
@endsection

@section('content')
<main class="main">
    <section class="section-box mt-0">
        <div class="">
            <div class="row m-0 profile-wrapper">
                <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

                    @include('healthcare.settings.sidebar')
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
                    <div class="content-single content_profile">
                        <div class="tab-content">
                                <?php $user_id = '';
                                $i = 0; ?>

                            <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">


                                <div class="card shadow-sm border-0 p-4 mt-30">

                                    <h3 class="mt-0 color-brand-1 mb-2">Support</h3>
                                    
                                    <div class="quill_rendered_content compliance_content">
                                        <div class="support_content_page">

                                            
                                            <p>
                                                Need help using Mediqa? We’re here to support you.
                                            </p>

                                            <p>
                                                Whether you have questions about your account, profile setup, document uploads, 
                                                job applications, subscriptions, or general platform use, our team is available to help.
                                            </p>

                                            <p>
                                                If you need assistance, please contact us at:
                                            </p>

                                            <p>
                                                <a href="mailto:support@mediqa.com"><strong>support@mediqa.com</strong></a>
                                            </p>

                                            <p>
                                                Our support team will do their best to respond as quickly as possible during business hours.
                                            </p>

                                            <h6 class="emergency_text">Help &amp; Resources</h6>

                                            <p>
                                                We’ve created helpful resources to make using Mediqa simple and straightforward.
                                            </p>

                                            <h6 class="emergency_text">FAQs / Help Centre</h6>

                                            <p>
                                                Visit our Help Centre to find answers to commonly asked questions, including:
                                            </p>

                                            <ul>
                                                <li>Creating and managing your account</li>
                                                <li>Completing your profile</li>
                                                <li>Uploading compliance documents</li>
                                                <li>Applying for jobs</li>
                                                <li>Managing subscriptions and billing</li>
                                                <li>Troubleshooting common issues</li>
                                            </ul>

                                            <p>
                                                Our FAQ section is designed to help you quickly find the information you need.
                                            </p>

                                            <h6 class="emergency_text">“How Mediqa Works” Guides</h6>

                                            <p>
                                                Our step-by-step guides explain how to use the platform effectively, including:
                                            </p>

                                            <ul>
                                                <li>How to register and create your account</li>
                                                <li>How to build and update your profile</li>
                                                <li>How to upload and manage required documents</li>
                                                <li>How to search and apply for jobs</li>
                                                <li>How to manage your subscription and account settings</li>
                                            </ul>

                                            <p>
                                                These guides are designed to help you get started with confidence and make the most of the Mediqa platform.
                                            </p>

                                            <h6 class="emergency_text">Still Need Help?</h6>

                                            <p>
                                                If you can’t find the answer you’re looking for, please reach out to our support team at:
                                            </p>

                                            <p>
                                                <a href="mailto:support@mediqa.com"><strong>support@mediqa.com</strong></a>
                                            </p>

                                            <p>
                                                We’re here to help.
                                            </p>

                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </section>
</main>
@endsection