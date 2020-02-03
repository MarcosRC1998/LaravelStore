@extends('layouts.app')

@section('content')

    <div class="container my-5">
        <div class="row">

            {{-- Asides --}}
            <div class="col-md-3">

                {{-- Categories --}}
                <aside class="filter bg-white shadow-sm mb-4">
                    <h5 class="title">Categories</h5>
                    <ul class="nav flex-column">
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link d-flex {{ ($currentCategory == $category->name) ? 'active' : '' }}"
                                   href="{{ route('products.index', ['category' => strtolower($category->name)]) }}">
                                    {{ $category->name }}
                                    <span class="ml-auto">({{ $category->products_count }})</span>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </aside>

                {{-- Other filters --}}
                <aside class="filter bg-white shadow-sm">
                    <h5 class="title">Filters</h5>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex" href="">
                                Filter 1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex" href="">
                                Filter 2
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>

            {{-- Products --}}
            <div class="col-md-9">

                {{-- products top bar --}}
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center">

                            {{-- Actual category --}}
                            <div>
                                <h3 class="mb-0">
                                    {{ $currentCategory }}
                                </h3>
                            </div>

                            <div class="d-flex">
                                {{-- Sort by button --}}
                                <div class="ml-3 filter-dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="sortByDropdown"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort By
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortByDropdown">
                                        <a href="{{ route('products.index',
                                                    ['category' => request()->category,
                                                     'show' => request()->show,
                                                     'sort' => 'az'])
                                                 }}"
                                           class="dropdown-item {{ (request()->sort == 'az' ) ? 'active' : '' }}">
                                            Name, A to Z
                                        </a>
                                        <a href="{{ route('products.index',
                                                    ['category' => request()->category,
                                                     'show' => request()->show,
                                                     'sort' => 'za'])
                                                 }}"
                                           class="dropdown-item {{ (request()->sort == 'za' ) ? 'active' : '' }}">
                                            Name, Z to A
                                        </a>
                                        <a href="{{ route('products.index',
                                                    ['category' => request()->category,
                                                     'show' => request()->show,
                                                     'sort' => 'low_high'])
                                                 }}"
                                           class="dropdown-item {{ (request()->sort == 'low_high' ) ? 'active' : '' }}">
                                            Price, low to high
                                        </a>
                                        <a href="{{ route('products.index',
                                                    ['category' => request()->category,
                                                     'show' => request()->show,
                                                     'sort' => 'high_low'])
                                                 }}"
                                           class="dropdown-item {{ (request()->sort == 'high_low' ) ? 'active' : '' }}">
                                            Price, high to low
                                        </a>
                                    </div>
                                </div>

                                {{-- Quantity shown --}}
                                <div class="ml-3 filter-dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="showQuantityDropdown"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Show {{ $products->perPage() }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"
                                         aria-labelledby="showQuantityDropdown">
                                        <a href="{{ route('products.index',
                                                    ['category' => request()->category,
                                                     'sort' => request()->sort,
                                                     'show' => 9])
                                                 }}"
                                           class="dropdown-item {{ (request()->show == '9' ) ? 'active' : '' }}">
                                            Show 9
                                        </a>
                                        <a href="{{ route('products.index',
                                                    ['category' => request()->category,
                                                     'sort' => request()->sort,
                                                     'show' => 15])
                                                 }}"
                                           class="dropdown-item {{ (request()->show == '15' ) ? 'active' : '' }}">
                                            Show 15
                                        </a>
                                        <a href="{{ route('products.index',
                                                    ['category' => request()->category,
                                                     'sort' => request()->sort,
                                                     'show' => 30])
                                                 }}"
                                           class="dropdown-item {{ (request()->show == '30' ) ? 'active' : '' }}">
                                            Show 30
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Products--}}
                @if($products->count() > 0)
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4 mb-4">
                                @component('app.components.card-product')
                                    @slot('image', 'https://via.placeholder.com/240x200')

                                    @slot('name')
                                        {{ $product->name }} - {{ $product->category->name }}
                                    @endslot

                                    @slot('price', str_replace('.', ',', $product->price))

                                    @slot('slug', $product->slug)
                                @endcomponent
                            </div>
                        @endforeach
                    </div>

                    {{-- Show more button --}}
                    {{--<div class="row justify-content-center">
                        <button class="btn btn-outline-secondary">Show more</button>
                    </div>--}}

                    {{-- Pagination --}}
                    <div class="row justify-content-center mt-4">
                        {{ $products->appends(request()->input())->links() }}
                    </div>

                @else
                    <div class="row justify-content-center">
                        <h1>I'm sorry, there aren't any product here!</h1>
                    </div>
                @endif

            </div>

        </div>
    </div>

@endsection
