 <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left">
                            <div class="dropdown category-dropdown has-border" data-visible="true">
                                <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true" data-display="static"
                                    title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>

                                <div class="dropdown-box">
                                    <ul class="menu vertical-menu category-menu">
                                        @php
                                        $categoryD = DB::table('category')->where('parent_id',0)->orderBy('id','DESC')->get();
                                        @endphp
                                        @if (isset($categoryD) && count($categoryD) > 0)
                                            @foreach ($categoryD as $categoryDataValue)
                                                <li>
                                                    @php
                                                    $subcategoryData = DB::table('category')
                                                        ->where('parent_id', $categoryDataValue->id)
                                                        ->get();
                                                    @endphp
                                                    @if (isset($subcategoryData) && count($subcategoryData) > 0)
                                                    <a href="#">
                                                        <i
                                                            class="{{ $categoryDataValue->icon }}"></i>{{ $categoryDataValue->category_name }}
                                                    </a>
                                                    @else
                                                    <a href="{{route('search-product',['id'=>$categoryDataValue->id])}}">
                                                        <i
                                                            class="{{ $categoryDataValue->icon }}"></i>{{ $categoryDataValue->category_name }}
                                                    </a>
                                                    @endif
                                                   
                                                    @if (isset($subcategoryData) && count($subcategoryData) > 0)
                                                        <ul class="megamenu">
                                                            @foreach ($subcategoryData as $subcategoryDataValue)
                                                                <li>
                                                                    @php
                                                                        $subsubcategoryData = DB::table('category')
                                                                            ->where('parent_id', $subcategoryDataValue->id)
                                                                            ->get();
                                                                    @endphp
                                                                    @if(isset($subsubcategoryData) && count($subsubcategoryData) > 0)
                                                                     <h4 class="menu-title">
                                                                        {{ $subcategoryDataValue->category_name }}
                                                                     </h4>
                                                                    @else
                                                                    <h4 class="menu-title">
                                                                        <a href="{{route('search-product',['id'=>$subcategoryDataValue->id])}}">{{ $subcategoryDataValue->category_name }}</a>
                                                                     </h4>
                                                                    @endif
                                                                     <hr class="divider">
                                                                    @if (isset($subsubcategoryData))
                                                                        @foreach ($subsubcategoryData as $subsubcategoryDataValue)
                                                                            <ul>
                                                                                <li><a
                                                                                        href="{{route('search-product',['id'=>$subsubcategoryDataValue->id])}}">{{ $subsubcategoryDataValue->category_name }}</a>
                                                                                </li>
        
                                                                            </ul>
                                                                        @endforeach
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                            
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <div class="header-right">
                            <a href="{{ route('account.login') }}" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                            <!-- <a href="#"><i class="w-icon-sale"></i>Daily Deals</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End of Header -->