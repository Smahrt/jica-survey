<!-- app/views/login.blade.php -->
@extends('layouts.login')
@section('title', 'Login')

@section('content')
    <!-- BEGIN LOGIN SECTION -->
    <section class="section-account">

        <div class="spacer"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">

            <?php if( isset($error) ): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
            <?php endif; ?>

             <div class="card">
                <div class="card-header style-primary" data-background-color ="orange">
                        <h4 class="title">Login</h4>
                </div>
                <div class="card-content">
                    <form class="form" action="signin" accept-charset="utf-8" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" required autocomplete="off" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" required autocomplete="off" id="password" name="password">
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-xs-6"></div>
                            <div class="col-xs-6 text-right">
                                <button data-background-color ="orange" name="submit" value="submit" class="btn btn-primary" type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Hold on...">Login</button>
                            </div><!--end .col -->
                        </div><!--end .row -->
                    </form>
                </div><!--end .card-body -->
            </div><!--end .card -->
        </div>
        <div class="col-sm-3"></div>
    </section>
    <!-- END LOGIN SECTION -->
@endsection
