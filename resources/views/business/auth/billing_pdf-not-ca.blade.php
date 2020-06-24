@extends('layouts.main_business')

@section('content')

	{{--//TODO Need change layout--}}

	<style>
		body {
			background: #ffffff !important;
		}
		.navbar {
			display: none;
		}
	</style>


	<div class="container">
		<div class="row mb-5 pb-5">
			<div class="col-12 pb-5 mx-auto">
				<div class="row mb-5">
					<div class="col-8">
						<h2>CloudResume</h2>
						<p>252 Brunelle, Beloeil, <br> Quebec, Canada, H2K 4J5</p>
					</div>
					<div class="col align-self-end">
						<div class="text-center">
							<h2>Receipt</h2><br>
							<img src="<?php echo e(asset('img/logo-large.png')); ?>" height="80" class="d-inline-block align-top" alt=""><br>
							<span>CloudResume</span>
						</div>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-7">
						<strong>Bill to</strong><br>
						<span>Business name</span><br>
						<span>Address of business</span>
					</div>
					<div class="col-5">
						<div class="row">
							<div class="col-6">
								<strong>Receipt #</strong>
							</div>
							<div class="col-6">
								<strong>0000000001</strong>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<strong>Receipt date</strong>
							</div>
							<div class="col-6">
								<strong>1/01/20018</strong>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<table class="table table-bordered border-0">
							<thead>
							<tr class="table-secondary">
								<th class="text-center">Description</th>
								<th class="text-center">Unit cost</th>
								<th class="text-center">Times</th>
								<th class="text-center">Discount</th>
								<th class="text-center">Amount</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>Business managers</td>
								<td class="text-right">10.00</td>
								<td class="text-right">30</td>
								<td class="text-right">50%</td>
								<td class="text-right">150.00</td>
							</tr>
							<tr>
								<td>CloudResume Service</td>
								<td class="text-right">5.00</td>
								<td class="text-right">8</td>
								<td class="text-right">50%</td>
								<td class="text-right">20.00</td>
							</tr>
							<tr>
								<td>Save 10 promo code</td>
								<td class="text-right">(10.00)</td>
								<td class="text-right">1</td>
								<td class="text-right"></td>
								<td class="text-right">(10.00)</td>
							</tr>
							<tr>
								<td colspan="4" class="text-right border-0">Subtotal</td>
								<td class="text-right">160.00</td>
							</tr>
							<tr>
								<td colspan="4" class="text-right border-0">
									<strong>Total</strong>
								</td>
								<td class="table-secondary text-right">
									$184.38 USD
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-12 mx-auto my-5 py-5">
				<strong class="mb-3">Terms and conditions</strong>
				<p class="mb-3">
					All prices are shown in USD.
					This amount is recurring and will be charged on your account next month. <br>
					If you have any questions regarding this receipt, contact us at: 1-877-181-1919 or by email at: <br>
					<a href="#" class="mb-2">financial@jobmap.co</a>
				</p>
				<p class="mb-3">Always a pleasure to serve you in your quest to find the perfect candidate!<br>
					Thank you
				</p>
				<p>The CloudResume team</p>
			</div>
		</div>
	</div>

@endsection