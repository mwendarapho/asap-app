
@if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>
    </div>

@endif
@section('javascripts')
    <script type="text/javascript">
        $(document).ready(function(){

            // $('.alert').hide(15000);
            $('.alert').addClass('animate slideUp');



        });
    </script>
@endsection

