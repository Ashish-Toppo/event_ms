<!-- enrollment button -->
@if( $data['details']['need_enrollment'] == 1 )
    @if( $data['details']['ended'] == 1 )
        <div class="col-md-6 col-sm-12">
            <p class="text-danger">Enrollment Has Ended!</p>
        </div>
    @else 
        @if( $data['details']['enrollment'] == 1 )
            <div class="col-md-6 col-sm-12">
                <p>Enrollment is going on!</p>
                <a class="btn btn-outline-success" href="">Enroll Now!</a>
            </div>
        @else
            <div class="col-md-6 col-sm-12">
                <p class="text-danger">Enrollment Will Start Soon!</p>
                <a class="btn btn-outline-danger" href="#">Keep Checking!</a>
            </div>
        @endif
    @endif
@endif