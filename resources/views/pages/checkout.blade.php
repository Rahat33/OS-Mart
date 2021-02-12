@extends('layouts')
@section('content')

<section id="cart_items">
		<div class="container">
			
			<div class="register-req">
				<p>Please complite this form</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-8 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form action="{{url('/save-shipping')}}" method="post">
									{{csrf_field()}}
									<input type="text" placeholder="Email *" required="" name="shipping_email">
									<input type="text" placeholder="First Name *" required="" name="shipping_first_name">
									
									<input type="text" placeholder="Last Name *" required="" name="shipping_last_name">

									<input type="text" placeholder="Address *" required="" name="shipping_address">
									<input type="text" placeholder="Mobile Number *" required="" name="shipping_mobile_number">
									<input type="text" placeholder="City *" required="" name="shipping_city">
									<input type="submit" class="btn btn-warning" value="Complite"> 
								</form>
							</div>
						</div>
					</div>
										
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>


			
		</div>
	</section> <!--/#cart_items-->



@endsection