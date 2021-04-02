@extends('index')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css">
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
    </style>
    <div class="row">
        <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading" >
                    <div class="row justify-content-center">
                        <h3 class="panel-title display-td" style="margin-top: 15px;" >Payment Details</h3>
                        <div class="display-tr" >                            
                            <img class="img-responsive pull-right" src="https://drearth.com.au/drearth_theme/images/accepted_c22e0.png" style="width: 300px;">
                        </div>
                    </div>                    
                </div>

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
  
                    <form role="form" action="{{route('stripe.post')}}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                        @csrf
                        <input type="text" value="{{request()->room}}"    name="room" hidden>
                        <input type="text" value="{{request()->acc_no}}"  name="acc_no" hidden>
                        <input type="text" value="{{request()->country}}" name="country" hidden>
                        <input type="text" value="{{request()->from}}"    name="from" hidden>
                        <input type="text" value="{{request()->to}}"      name="to" hidden>
                        <input type="text" value="{{request()->price}}"   name="totalprice" hidden>
                        <div class='form-row row'>
                            <div class='col-md-12 form-group'>
                                <label class='control-label'>Name on Card</label>
                                 <input class='form-control' size='4' type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-md-12 form-group required'>
                                <label class='control-label'>Card Number</label> <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-md-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                 <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class='col-md-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> 
                                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-md-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> 
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide' hidden>
                                <div class='alert-danger alert'>Please correct the errors and try again.</div>
                            </div>
                        </div>
  
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>        
        </div>
        </div>
    </div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>  
<script type="text/javascript">

$(function() {
    var $form         = $(".require-validation")
  $('form.require-validation').bind('submit', function(e) {
   
    var $form         = $(".require-validation"),

        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),

        $errorMessage = $form.find('div.error'),

        valid         = true;

        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');

    $inputs.each(function(i, el) {
      
      var $input = $(el);

      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }

    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  
  });



  function stripeResponseHandler(status, response) {

        if (response.error) {
            $('.error')
                .removeClass('hide')
                .removeAttr('hidden')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
  }
  
});
</script>
@endsection