
@extends('layouts.app')
@section('content')


	<!-- hero -->
	<section class="hero">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-7 col-xl-6">
					<!-- hero first -->
					<div class="hero__content hero__content--first">
						<h1 class="hero__title"><strong>Neural technology</strong> <br>for arbitrage in the crypto industry</h1>

						<div class="hero__btns">
							<a href="signin.html" class="hero__btn">Register</a>
							<a href="about.html" class="hero__btn hero__btn--light">About us</a>
						</div>
					</div>
					<!-- end hero first -->
				</div>

				<div class="col-12 col-md-6 col-lg-5 col-xl-4 offset-xl-2">
					<!-- hero second -->
					<div class="hero__content hero__content--second">
						<!-- node -->
						<div class="node node--hero">
							<h3 class="node__title node__title--red"><b>30</b> Centure</h3>
							<span class="node__date">30 days</span>
							<span class="node__price">Promotional: <b>Free</b></span>
							<span class="node__line"><img src="img/dodgers/dots--line-red.svg" alt=""></span>

							<ul class="node__list">
								<li><i class="ti ti-circle-check"></i><b>1.1%</b> of the deposit amount</li>
								<li><i class="ti ti-circle-check"></i><b>+ 0.3%</b> daily profit</li>
							</ul>

							<!-- progressbar -->
							<div class="progressbar progressbar--cta">
								<h3 class="progressbar__title">Contestants:</h3>
								<div class="progress" role="progressbar" aria-label="Animated striped" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 75%"><span>75</span></div></div>
								<div class="progressbar__values">
									<span class="progressbar__value progressbar__value--left">0</span>
									<span class="progressbar__value progressbar__value--right">100</span>
								</div>
							</div>
							<!-- end progressbar -->

							<!-- design elements -->
							<span class="stats__dodger stats__dodger--left stats__dodger--red"></span>
							<span class="stats__dodger stats__dodger--right stats__dodger--red"></span>
							<span class="screw screw--br"></span>
							<span class="screw screw--bl"></span>
						</div>
						<!-- end node -->
					</div>
					<!-- end hero second -->
				</div>
			</div>
		</div>
	</section>
	<!-- end hero -->

	<!-- statistics -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6 col-xl-3">
					<!-- stats -->
					<div class="stats">
						<span class="stats__value">1839</span>
						<p class="stats__name">Days on the market</p>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--purple"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--purple"></span>
					</div>
					<!-- end stats -->
				</div>

				<div class="col-12 col-sm-6 col-xl-3">
					<!-- stats -->
					<div class="stats">
						<span class="stats__value">5812</span>
						<p class="stats__name">Members</p>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--orange"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--orange"></span>
					</div>
					<!-- end stats -->
				</div>

				<div class="col-12 col-sm-6 col-xl-3">
					<!-- stats -->
					<div class="stats">
						<span class="stats__value">$374 103</span>
						<p class="stats__name">Arbitrage pools</p>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--green"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--green"></span>
					</div>
					<!-- end stats -->
				</div>

				<div class="col-12 col-sm-6 col-xl-3">
					<!-- stats -->
					<div class="stats">
						<span class="stats__value">$100 812</span>
						<p class="stats__name">Total paid</p>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--blue"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--blue"></span>
					</div>
					<!-- end stats -->
				</div>
			</div>
		</div>
	</div>
	<!-- end statistics -->

	<!-- arbitrage pools -->
	<div class="section">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
					<div class="section__title">
						<h2>Arbitrage pools</h2>
						<p>Join arbitrage pools and unlock the potential of partnership to maximize returns from cryptocurrency arbitrage.</p>
					</div>
				</div>
				<!-- end title -->
			</div>

			<div class="row">
				<div class="col-12 col-md-6 col-lg-4">
					<!-- arbitrage pool -->
					<div class="apool">
						<h3 class="apool__title">Maximum</h3>

						<!-- tabs nav -->
						<ul class="nav nav-tabs apool__tabs apool__tabs--orange" id="apool__tabs1" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="active" data-bs-toggle="tab" data-bs-target="#atab-1" type="button" role="tab" aria-controls="atab-1" aria-selected="true">2 months</button>
							</li>

							<li class="nav-item" role="presentation">
								<button data-bs-toggle="tab" data-bs-target="#atab-2" type="button" role="tab" aria-controls="atab-2" aria-selected="false">6 months</button>
							</li>
						</ul>
						<!-- tabs nav -->

						<!-- tabs content -->
						<div class="tab-content">
							<div class="tab-pane fade show active" id="atab-1" role="tabpanel">
								<div class="apool__content">
									<span class="apool__value">$500 - $2500</span>
									<span class="apool__profit">Daily profit (%): <b>0.35</b></span>
								</div>
							</div>

							<div class="tab-pane fade" id="atab-2" role="tabpanel">
								<div class="apool__content">
									<span class="apool__value">$800 - $3000</span>
									<span class="apool__profit">Daily profit (%): <b>0.42</b></span>
								</div>
							</div>
						</div>
						<!-- end tabs content -->

						<div class="apool__group">
							<label for="pool1" class="apool__label">Enter amount</label>
							<input id="pool1" name="pool1" type="text" class="apool__input">
						</div>

						<button class="apool__btn" data-bs-target="#modal-apool" type="button" data-bs-toggle="modal">Invest</button>

						<!-- design elements -->
						<span class="block-icon block-icon--orange">
							<i class="ti ti-database-dollar"></i>
						</span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end arbitrage pool -->
				</div>

				<div class="col-12 col-md-6 col-lg-4">
					<!-- arbitrage pool -->
					<div class="apool">
						<h3 class="apool__title">Standard</h3>

						<!-- tabs nav -->
						<ul class="nav nav-tabs apool__tabs apool__tabs--green" id="apool__tabs2" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="active" data-bs-toggle="tab" data-bs-target="#atab-3" type="button" role="tab" aria-controls="atab-3" aria-selected="true">7 weeks</button>
							</li>

							<li class="nav-item" role="presentation">
								<button data-bs-toggle="tab" data-bs-target="#atab-4" type="button" role="tab" aria-controls="atab-4" aria-selected="false">20 weeks</button>
							</li>
						</ul>
						<!-- tabs nav -->

						<!-- tabs content -->
						<div class="tab-content">
							<div class="tab-pane fade show active" id="atab-3" role="tabpanel">
								<div class="apool__content">
									<span class="apool__value">$400 - $2000</span>
									<span class="apool__profit">Daily profit (%): <b>0.31</b></span>
								</div>
							</div>

							<div class="tab-pane fade" id="atab-4" role="tabpanel">
								<div class="apool__content">
									<span class="apool__value">$600 - $2500</span>
									<span class="apool__profit">Daily profit (%): <b>0.37</b></span>
								</div>
							</div>
						</div>
						<!-- end tabs content -->

						<div class="apool__group">
							<label for="pool2" class="apool__label">Enter amount</label>
							<input id="pool2" name="pool2" type="text" class="apool__input">
						</div>

						<button class="apool__btn" data-bs-target="#modal-apool" type="button" data-bs-toggle="modal">Invest</button>

						<!-- design elements -->
						<span class="block-icon block-icon--green">
							<i class="ti ti-database-dollar"></i>
						</span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end arbitrage pool -->
				</div>

				<div class="col-12 col-lg-4">
					<!-- arbitrage pool -->
					<div class="apool">
						<h3 class="apool__title">Lite</h3>

						<!-- tabs nav -->
						<ul class="nav nav-tabs apool__tabs apool__tabs--blue" id="apool__tabs3" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="active" data-bs-toggle="tab" data-bs-target="#atab-5" type="button" role="tab" aria-controls="atab-5" aria-selected="true">30 days</button>
							</li>

							<li class="nav-item" role="presentation">
								<button data-bs-toggle="tab" data-bs-target="#atab-6" type="button" role="tab" aria-controls="atab-6" aria-selected="false">50 days</button>
							</li>
						</ul>
						<!-- tabs nav -->

						<!-- tabs content -->
						<div class="tab-content">
							<div class="tab-pane fade show active" id="atab-5" role="tabpanel">
								<div class="apool__content">
									<span class="apool__value">$250 - $900</span>
									<span class="apool__profit">Daily profit (%): <b>0.24</b></span>
								</div>
							</div>

							<div class="tab-pane fade" id="atab-6" role="tabpanel">
								<div class="apool__content">
									<span class="apool__value">$350 - $1400</span>
									<span class="apool__profit">Daily profit (%): <b>0.29</b></span>
								</div>
							</div>
						</div>
						<!-- end tabs content -->

						<div class="apool__group">
							<label for="pool3" class="apool__label">Enter amount</label>
							<input id="pool3" name="pool3" type="text" class="apool__input">
						</div>

						<button class="apool__btn" data-bs-target="#modal-apool" type="button" data-bs-toggle="modal">Invest</button>

						<!-- design elements -->
						<span class="block-icon block-icon--blue">
							<i class="ti ti-database-dollar"></i>
						</span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end arbitrage pool -->
				</div>
			</div>
		</div>
	</div>
	<!-- end arbitrage pools -->

	<!-- token -->
	<div class="section">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
					<div class="section__title">
						<h2>Centure Token</h2>
						<p>More features with own Centure token.</p>
					</div>
				</div>
				<!-- end title -->
			</div>

			<div class="row row--relative">
				<div class="col-12">
					<!-- invest -->
					<div class="invest invest--big">
						<h2 class="invest__title">Centure Token</h2>

						<div class="row">
							<div class="col-12 col-lg-5">
								<div class="invest__rate-wrap">
									<div class="invest__rate">
										<span>Current course</span>
										<p>1 Ctr = $0.791</p>
									</div>

									<div class="invest__graph">
										<img src="img/graph/graph2.svg" alt="">
									</div>
								</div>
							</div>

							<div class="col-12 col-lg-5 offset-lg-1">
								<div class="invest__rate-wrap">
									<div class="invest__rate">
										<span>Week</span>
										<!-- or .red -->
										<p class="green">+0.19% <small>[0.84]</small></p>
									</div>

									<div class="invest__graph">
										<img src="img/graph/graph1.svg" alt="">
									</div>
								</div>
							</div>

							<div class="col-12 col-lg-5">
								<div class="invest__rate-wrap">
									<div class="invest__rate">
										<span>Month</span>
										<p class="red">-2.84% <small>[0.02]</small></p>
									</div>

									<div class="invest__graph">
										<img src="img/graph/graph3.svg" alt="">
									</div>
								</div>
							</div>

							<div class="col-12 col-lg-5 offset-lg-1">
								<div class="invest__rate-wrap">
									<div class="invest__rate">
										<span>All the time</span>
										<p class="green">+65.10% <small>[49.68]</small></p>
									</div>

									<div class="invest__graph">
										<img src="img/graph/graph4.svg" alt="">
									</div>
								</div>
							</div>
						</div>

						<p class="invest__info">Centure is a proprietary token of the Centure TRADE project. It is a full-fledged trading unit. Centure was developed as a universal means of payment, allowing people to profit at the actual rate of their currency in the arbitrage pool. Centure token does not depend on the cryptocurrency market and is completely in its own ecosystem.</p>

						<!-- design elements -->
						<span class="block-icon block-icon--purple">
							<i class="ti ti-brand-coinbase"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end invest -->
				</div>

				<!-- animation background -->
				<div class="section__canvas section__canvas--page section__canvas--first" id="canvas"></div>
			</div>
		</div>
	</div>
	<!-- end token -->

	<!-- nodes -->
	<section class="section">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<div class="section__title">
						<h2>Arbitrage Nodes</h2>
						<p>Secure a unique opportunity to engage in cryptocurrency arbitrage by acquiring arbitrage nodes on our platform.</p>
					</div>
				</div>
				<!-- end title -->
			</div>

			<div class="row">
				<div class="col-12 col-md-6 col-lg-4">
					<!-- node -->
					<div class="node">
						<h3 class="node__title node__title--orange"><b>100</b> Centure</h3>
						<span class="node__date">30 days</span>
						<span class="node__price">Partner course: <b>$59.64</b></span>
						<span class="node__line"><img src="img/dodgers/dots--line-orange.svg" alt=""></span>

						<ul class="node__list">
							<li><i class="ti ti-circle-check"></i><b>3%</b> of the deposit amount</li>
							<li><i class="ti ti-circle-check"></i><b>$100</b> to the principal balance</li>
							<li><i class="ti ti-circle-check"></i><b>$200</b> bonus balance</li>
							<li><i class="ti ti-circle-check"></i><b>+ 0.5%</b> daily profit</li>
						</ul>

						<button class="node__btn" data-bs-target="#modal-node" type="button" data-bs-toggle="modal">Buy Nodes</button>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--orange"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--orange"></span>
					</div>
					<!-- end node -->
				</div>

				<div class="col-12 col-md-6 col-lg-4">
					<!-- node -->
					<div class="node">
						<h3 class="node__title node__title--green"><b>200</b> Centure</h3>
						<span class="node__date">45 days</span>
						<span class="node__price">Partner course: <b>$119.28</b></span>
						<span class="node__line"><img src="img/dodgers/dots--line-green.svg" alt=""></span>

						<ul class="node__list">
							<li><i class="ti ti-circle-check"></i><b>5%</b> of the deposit amount</li>
							<li><i class="ti ti-circle-check"></i><b>$200</b> to the principal balance</li>
							<li><i class="ti ti-circle-check"></i><b>$300</b> bonus balance</li>
							<li><i class="ti ti-circle-check"></i><b>+ 0.9%</b> daily profit</li>
						</ul>

						<button class="node__btn" data-bs-target="#modal-node" type="button" data-bs-toggle="modal">Buy Nodes</button>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--green"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--green"></span>
					</div>
					<!-- end node -->
				</div>

				<div class="col-12 col-lg-4">
					<!-- node -->
					<div class="node">
						<h3 class="node__title node__title--blue"><b>500</b> Centure</h3>
						<span class="node__date">60 days</span>
						<span class="node__price">Partner course: <b>$298.20</b></span>
						<span class="node__line"><img src="img/dodgers/dots--line-blue.svg" alt=""></span>

						<ul class="node__list">
							<li><i class="ti ti-circle-check"></i><b>7%</b> of the deposit amount</li>
							<li><i class="ti ti-circle-check"></i><b>$400</b> to the principal balance</li>
							<li><i class="ti ti-circle-check"></i><b>$600</b> bonus balance</li>
							<li><i class="ti ti-circle-check"></i><b>+ 1.8%</b> daily profit</li>
						</ul>

						<button class="node__btn" data-bs-target="#modal-node" type="button" data-bs-toggle="modal">Buy Nodes</button>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--blue"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--blue"></span>
					</div>
					<!-- end node -->
				</div>
			</div>
		</div>
	</section>
	<!-- end nodes -->

	<!-- affiliate -->
	<section class="section">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
					<div class="section__title">
						<h2>Promotion bonus</h2>
						<p>The affiliate program will allow you to increase your income by receiving a percentage of the arbitrage pool opened by your referrals. Invite your friends to join the company.</p>
					</div>
				</div>
				<!-- end title -->
			</div>

			<div class="row row--relative">
				<div class="col-12 col-lg-6">
					<!-- invest -->
					<div class="invest invest--big">
						<h2 class="invest__title">Volume bonus</h2>

						<p class="invest__text">The larger the arbitrage pool volume, the more bonus will be awarded upon reaching these goals!</p>

						<table class="invest__table">
							<thead>
								<tr>
									<th>Bonus</th>
									<th>Turnover</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>$100</td>
									<td>$1 000 000</td>
								</tr>
								<tr>
									<td>$250</td>
									<td>$3 000 000</td>
								</tr>
								<tr>
									<td>$400</td>
									<td>$5 000 000</td>
								</tr>
								<tr>
									<td>$650</td>
									<td>$7 000 000</td>
								</tr>
								<tr>
									<td class="blue">to $50 000</td>
									<td>$10 000 000</td>
								</tr>
							</tbody>
						</table>

						<!-- design elements -->
						<span class="block-icon block-icon--blue">
							<i class="ti ti-mood-dollar"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end invest -->
				</div>

				<div class="col-12 col-lg-6">
					<!-- invest -->
					<div class="invest invest--big">
						<h2 class="invest__title">Leadership bonus</h2>

						<p class="invest__text">It is accrued on the first day of each month and depends on the turnover of arbitrage pools of the first level.</p>

						<table class="invest__table">
							<thead>
								<tr>
									<th>Bonus</th>
									<th>Pool</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>$500</td>
									<td>$4 000</td>
								</tr>
								<tr>
									<td>$1 250</td>
									<td>$8 000</td>
								</tr>
								<tr>
									<td>$2 500</td>
									<td>$12 000</td>
								</tr>
								<tr>
									<td>$7 000</td>
									<td>$24 000</td>
								</tr>
								<tr>
									<td class="yellow">$29 000</td>
									<td>$99 000</td>
								</tr>
							</tbody>
						</table>

						<!-- design elements -->
						<span class="block-icon block-icon--yellow">
							<i class="ti ti-trophy"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end invest -->
				</div>

				<!-- animation background -->
				<div class="section__canvas section__canvas--page section__canvas--second" id="canvas2"></div>
			</div>

			<div class="row">
				<div class="col-12">
					<!-- section btns -->
					<div class="section__btns">
						<a href="signin.html" class="section__btn">Become</a>
					</div>
					<!-- end section btns -->
				</div>
			</div>
		</div>
	</section>
	<!-- end affiliate -->

	<!-- partners -->
	<section class="section">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-8 offset-xl-2">
					<div class="section__title">
						<h2>Our partners</h2>
						<p>We take pride in collaborating with our partners who help us provide the best services to our clients. If you'd like to become our partner, please <a href="contacts.html">contact us.</a></p>
					</div>
				</div>
				<!-- end title -->
			</div>

			<div class="row">
				<div class="col-6 col-lg-3">
					<!-- partner -->
					<a href="#" class="partner">
						<img src="img/partners/logo1.svg" alt="">
						<p>thesponsor.com</p>

						<!-- design elements -->
						<span class="screw screw--br"></span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--tl"></span>
					</a>
					<!-- end partner -->
				</div>

				<div class="col-6 col-lg-3">
					<!-- partner -->
					<a href="#" class="partner">
						<img src="img/partners/logo2.svg" alt="">
						<p>thesponsor.com</p>

						<!-- design elements -->
						<span class="screw screw--br"></span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--tl"></span>
					</a>
					<!-- end partner -->
				</div>

				<div class="col-6 col-lg-3">
					<!-- partner -->
					<a href="#" class="partner">
						<img src="img/partners/logo3.svg" alt="">
						<p>thesponsor.com</p>

						<!-- design elements -->
						<span class="screw screw--br"></span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--tl"></span>
					</a>
					<!-- end partner -->
				</div>

				<div class="col-6 col-lg-3">
					<!-- partner -->
					<a href="#" class="partner">
						<img src="img/partners/logo4.svg" alt="">
						<p>thesponsor.com</p>

						<!-- design elements -->
						<span class="screw screw--br"></span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--tl"></span>
					</a>
					<!-- end partner -->
				</div>

				<div class="col-6 col-lg-3">
					<!-- partner -->
					<a href="#" class="partner">
						<img src="img/partners/logo5.svg" alt="">
						<p>thesponsor.com</p>

						<!-- design elements -->
						<span class="screw screw--br"></span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--tl"></span>
					</a>
					<!-- end partner -->
				</div>

				<div class="col-6 col-lg-3">
					<!-- partner -->
					<a href="#" class="partner">
						<img src="img/partners/logo6.svg" alt="">
						<p>thesponsor.com</p>

						<!-- design elements -->
						<span class="screw screw--br"></span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--tl"></span>
					</a>
					<!-- end partner -->
				</div>

				<div class="col-6 col-lg-3">
					<!-- partner -->
					<a href="#" class="partner">
						<img src="img/partners/logo7.svg" alt="">
						<p>thesponsor.com</p>

						<!-- design elements -->
						<span class="screw screw--br"></span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--tl"></span>
					</a>
					<!-- end partner -->
				</div>

				<div class="col-6 col-lg-3">
					<!-- partner -->
					<a href="#" class="partner">
						<img src="img/partners/logo8.svg" alt="">
						<p>thesponsor.com</p>

						<!-- design elements -->
						<span class="screw screw--br"></span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--tl"></span>
					</a>
					<!-- end partner -->
				</div>
			</div>
		</div>
	</section>
	<!-- end partners -->
    @endsection


