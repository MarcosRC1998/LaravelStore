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
                        <li class="nav-item">
                            <a class="nav-link d-flex active" href="">
                                All
                                <span class="ml-auto">(100)</span>
                            </a>
                        </li>

                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link d-flex" href="">
                                    {{ ucfirst($category->name) }}
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
                                <h3 class="mb-0">All</h3>
                            </div>

                            <div class="d-flex">

                                {{-- Temporary button to create new product page --}}
                                <a href="{{ route('products.create') }}" class="btn btn-danger">Create new</a>

                                {{-- Sort by button --}}
                                <div class="ml-3 filter-dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="sortByDropdown"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort By
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortByDropdown">
                                        <a href="" class="dropdown-item">
                                            Name, A to Z
                                        </a>
                                        <a href="" class="dropdown-item">
                                            Name, Z to A
                                        </a>
                                        <a href="" class="dropdown-item">
                                            Price, low to high
                                        </a>
                                        <a href="" class="dropdown-item">
                                            Price, high to low
                                        </a>
                                    </div>
                                </div>

                                {{-- Quantity shown --}}
                                <div class="ml-3 filter-dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="showQuantityDropdown"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Show 15
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"
                                         aria-labelledby="showQuantityDropdown">
                                        <a href="" class="dropdown-item active">
                                            Show 15
                                        </a>
                                        <a href="" class="dropdown-item">
                                            Show 30
                                        </a>
                                        <a href="" class="dropdown-item">
                                            Show 45
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Products--}}
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            @component('app.components.card-product')
                                @slot('image', 'https://via.placeholder.com/240x200')

                                @slot('name')
                                    {{ $product->name }}
                                @endslot

                                @slot('active', $product->active)

                                @slot('price', str_replace('.', ',', $product->price))

                                @slot('slug', $product->slug)
                            @endcomponent
                        </div>
                    @endforeach
                </div>

                {{-- Show more button --}}
                <div class="row justify-content-center">
                    <button class="btn btn-outline-secondary">Show more</button>
                </div>

                {{-- Pagination --}}
                <div class="row justify-content-center mt-4">
                    <nav aria-label="Page navigation products">
                        <ul class="pagination shadow-sm">
                            <li class="page-item">
                                <a class="page-link" href="" aria-label="Previous">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="">1</a></li>
                            <li class="page-item"><a class="page-link" href="">2</a></li>
                            <li class="page-item"><a class="page-link" href="">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="" aria-label="Next">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>

        </div>
    </div>

@endsection
