
@extends('layouts.admin')
@section('content')
<div class="page text-center">

  <!-- Page Head-->
        <!-- Page Contents-->
  <main class="page-content">
    <!-- Search Engine-->
    <section class="section-98 section-sm-110">
      <div class="shell">
        <div class="offset-sm-top-66">
           {{-- <center>
            <img class='img-responsive' style='margin-top: -20px;margin-left: -5px;' width='329' height='67' src="#" alt=''/>
          </center> --}}
          <!-- Responsive-tabs-->
          <div data-type="horizontal" class="responsive-tabs responsive-tabs-classic">
            <p class="text-center alert alert-info">Welcome to ECART <br> please verify your account by entering digits  sent via sms.</p>
          </div>

          Thanks,<br>
{{ config('app.name') }}
        </div>
      </div>
    </section>
  </main>
</div>
@endsection

