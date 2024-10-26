<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.appBack') <!-- Extending the layout file -->

@section('title', 'Dashboard') <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-primary border-radius-lg pt-3 pb-2">
                        <h6 class="text-white text-capitalize ps-3">User reviews</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guesthouse</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rating</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Content</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ Vite::asset('resources/assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $review->user->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $review->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $review->guesthouse->name }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ $review->guesthouse->location }}</p>
                                    </td>

                                    <td>
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="bi bi-star-fill align-baseline @if ($i < floor($review->rating)) text-warning @else text-muted @endif"></i>
                                        @endfor
                                    </div>

                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ \Illuminate\Support\Str::limit($review->title, 25) }} <!-- Limit title to 30 characters -->
                                        </p>
                                    </td>

                                    <td>
                                        <p class="text-xs mb-0">
                                            {{ \Illuminate\Support\Str::limit($review->content, 35) }} <!-- Limit content to 50 characters -->
                                        </p>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        @if($review->status)
                                        <span class="badge badge-sm bg-gradient-success">Active</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-danger">Blocked</span>
                                        @endif
                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $review->created_at->format('Y-m-d, h:i A') }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-secondary" data-bs-toggle="modal" data-bs-target="#viewReview" style="cursor: pointer;"> <i class="fas fa-eye me-1"> </i> Check</span>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- View Review Modal -->
<div class="modal fade" id="viewReview" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewLabel">Review overview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <!-- view the review in this modal -->
                <div class="border border-dashed card rounded p-3 mb-1" style="transform: scale(0.98);">
                    <div class="hstack flex-wrap gap-3 mb-4">
                        <div class="badge rounded-pill bg-danger-subtle text-danger mb-0">
                            <i class="mdi mdi-star"></i> <span class="rate-num">{{ $review->rating }}</span>
                        </div>
                        <div class="vr"></div>
                        <div class="flex-grow-1">
                            <p class="mb-0"><strong> {{ $review->user->name }} </strong></p>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-muted fs-13 mb-0">{{ $review->created_at->format('Y-m-d, h:i A') }}</span>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-auto">
                            <h6 class="review-title fs-md">{{ $review->title }}</h6>
                            <p class="review-desc mb-0">{{ $review->content }}</p>
                        </div>

                        @if ($review->images) <!-- Check if images exist -->
                        <div class="d-flex flex-grow-1 gap-2 mt-3">
                            @foreach (json_decode($review->images, true) as $image)
                            <a href="javascript:void(0);" class="avatar-md">
                                <div class="avatar-title bg-light rounded">
                                    <img src="{{ asset($image) }}" alt="Product Image" class="product-img" width="110px">
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Button Container -->
                    <div class="d-flex justify-content-end align-items-center">
                        <form action="{{ route('admin.reviews.toggleStatus', $review) }}" method="POST" id="toggleStatusForm-{{ $review->id }}">
                            @csrf
                            <span class="badge badge-sm {{ $review->status ? 'bg-gradient-danger' : 'bg-gradient-success' }}" style="cursor: pointer;" onclick="document.getElementById('toggleStatusForm-{{ $review->id }}').submit();">
                                <i class="{{ $review->status ? 'fas fa-ban' : 'fas fa-check' }} me-1"></i>
                                {{ $review->status ? 'Block' : 'Unblock' }}
                            </span>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection <!-- End the content section -->