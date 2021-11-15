
@auth()

    @section('styles')
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @endsection

<nav class="col-md-2 d-none d-md-block bg-light sidebar d-print-none">

    <div class="sidebar-sticky">

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/') }}">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('invoice.index') }}">
                    <span data-feather="layers"></span>
                    Invoices
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('payment')}}">
                    <span data-feather="bar-chart-2"></span>
                    Payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('credit')}}">
                    <span data-feather="bar-chart-2"></span>
                    Credit Note
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ url('statement')}}">
                    <span data-feather="file-text"></span>
                    Statement
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.index') }}">
                    <span data-feather="users"></span>
                    All Members
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.current') }}">
                    <span data-feather="file-text"></span>
                    Current Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.past') }}">
                    <span data-feather="file-text"></span>
                   Past Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.sahayak') }}">
                    <span data-feather="file-text"></span>
                    Sahayak Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.full') }}">
                    <span data-feather="file-text"></span>
                    Full Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.paid') }}">
                    <span data-feather="file-text"></span>
                    Pay Status
                </a>
            </li>
           

        </ul>
    </div>

</nav>
@endauth
