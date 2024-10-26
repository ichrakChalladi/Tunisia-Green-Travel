<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app') <!-- Extending the layout file -->

@section('title', 'Dashboard') <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->

<div class="row mb-4">
    <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
        <div class="">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Ratings & Reviews</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">{{ $currentMonthReviews }} reviews </span> this month
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                                Add Review
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-0 pb-2 me-3">

                <div class="tab-pane active">

                    <div class="row gy-3">
                        <div class="col-lg-2">
                            <div class="text-center mt-3 mt-lg-5">

                                <div class="text-center mt-3 mt-lg-5">
                                    <h1 class="mb-0">{{ number_format($averageRating, 1) }} <small class="fs-sm text-muted fw-normal">/ 5.0</small></h1>
                                    <div class="text-warning hstack gap-2 justify-content-center mb-3">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="bi bi-star-fill align-baseline @if ($i < floor($averageRating)) text-warning @else text-muted @endif"></i>
                                            @endfor
                                    </div>
                                </div>
                                <p class="mb-0">
                                    <b>{{ $blogList->count() }}</b>
                                    {{ Str::plural('Review', $blogList->count()) }}
                                </p>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-10">
                            <div>
                                <div class="me-lg-n3 pe-lg-4" style="max-height: 500px;">
                                    <ul class="list-unstyled mb-0" id="review-list">
                                        @if($blogList->count() > 0)
                                        @foreach ($blogList as $review)
                                        <li class="review-list py-2" id="review-{{ $review->id }}">
                                            <div class="border border-dashed card rounded p-3 mb-1" style="transform: scale(0.98);">
                                                <div class="hstack flex-wrap gap-3 mb-4">
                                                    <div class="badge rounded-pill bg-danger-subtle text-danger mb-0">
                                                        <i class="mdi mdi-star"></i> <span class="rate-num">{{ $review->rating }}</span>
                                                    </div>
                                                    <div class="vr"></div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0"><strong> {{ $review->user->name }} </strong></p>
                                                    </div>
                                                    <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                                                        <i class="material-icons me-2 text-lg">date_range</i>
                                                        <small>{{ $review->created_at->format('h:i A, Y-m-d') }}</small>
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
                                                <div class="d-flex justify-content-end align-items-center" style="margin-bottom: -15px;">
                                                    <!-- Edit Button -->
                                                    <a href="#" class="btn btn-warning btn-sm rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 40px; height: 40px;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editReviewModal"
                                                        data-id="{{ $review->id }}"
                                                        data-title="{{ $review->title }}"
                                                        data-content="{{ $review->content }}"
                                                        data-rating="{{ $review->rating }}">
                                                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('blog.deleteReview', $review->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                                            <i class="bi bi-trash" style="font-size: 20px;"></i>
                                                        </button>
                                                    </form>
                                                </div>



                                            </div>
                                        </li>
                                        @endforeach
                                        
                                        @else
                                        <div class="container" style="margin-top: 60px;">
                                            <div class="alert alert-secondary alert-dismissible text-white mt-5" role="alert" >
                                                <span class="text-sm">There is no <a href="javascript:;" class="alert-link text-white">Reviews</a> yet!</span>
                                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Add Review Modal -->
<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewLabel">Add Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('blog.addReview') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="alert-error-msg" class="d-none alert alert-danger py-2"></div>

                    <input type="hidden" name="guesthouse_id" value="{{ $guesthouse->id }}">

                    <label for="exampleFormControlSelect1" class="ms-0">Select Review <span class="text-danger">*</span></label>
                    <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="rating" id="exampleFormControlSelect1" required>
                            <option value="0" selected>Select a rating</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>

                    <label for="reviewTitle" class="form-label">Review Title <span class="text-danger">*</span></label>
                    <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="title" id="reviewTitle" placeholder="Title" required>
                    </div>

                    <label for="reviewContent" class="form-label">Review <span class="text-danger">*</span></label>
                    <div class="input-group input-group-outline mb-3">
                        <textarea class="form-control" name="content" id="reviewContent" rows="4" placeholder="Enter review" required></textarea>
                    </div>

                    <label for="reviewTitle" class="form-label">Experience image <span class="text-danger">*</span></label>
                    <div class="input-group input-group-outline mb-3">
                        <input id="input-b1" name="input-b1[]" type="file" class="file" multiple data-browse-on-zone-click="true">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Review</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Review Modal -->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReviewLabel">Edit Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editReviewForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div id="alert-error-msg" class="d-none alert alert-danger py-2"></div>

                    <label for="editRating" class="ms-0">Select Rating <span class="text-danger">*</span></label>
                    <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="rating" id="editRating" required>
                            <option value="0" selected>Select a rating</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>

                    <label for="editReviewTitle" class="form-label">Review Title <span class="text-danger">*</span></label>
                    <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="title" id="editReviewTitle" placeholder="Title" required>
                    </div>

                    <label for="editReviewContent" class="form-label">Review <span class="text-danger">*</span></label>
                    <div class="input-group input-group-outline mb-3">
                        <textarea class="form-control" name="content" id="editReviewContent" rows="4" placeholder="Enter review" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Review</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    // Event listener for the Edit button click
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const content = this.getAttribute('data-content');
            const rating = this.getAttribute('data-rating');

            // Populate the modal fields
            document.getElementById('editReviewTitle').value = title;
            document.getElementById('editReviewContent').value = content;
            document.getElementById('editRating').value = rating;

            // Update the form action URL
            const form = document.getElementById('editReviewForm');
            form.action = `{{ url('blog/overview/update-review') }}/${id}`;
        });
    });
</script>


@endsection <!-- End the content section --><!-- Add Review Modal -->