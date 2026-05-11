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
        line-height: 0.5 !important;
        color: #000 !important;
        padding-left: 24px !important;
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
        /* line-height: 1.8 !important; */
        line-height: 20px;
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

                                    <h3 class="mt-0 color-brand-1 mb-2">Compliance & Security</h3>
                                    
                                    <div class="quill_rendered_content compliance_content">
                                        {!! $content->compliance_content !!}
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