<html>
    <head>
    <link href="{{ asset('css/app.css') . "?".rand(0,100) }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>

<body>


	<section class="login">
		<div class="login_box">
			
			<div class="left">
				
				<!-- <div class="top_link"><a href="#"><img src="https://drive.google.com/u/0/uc?id=16U__U5dJdaTfNGobB_OpwAJ73vM50rPV&export=download" alt="">Return home</a></div> -->
				
				<div class="contact">
					
					<form method="POST" action="{{ route('login') }}">
                    @csrf
						<h3>SIGN IN</h3>
						@if(session()->has('status'))
							@if(session()->get('status')['code'] == 200)
								<div class="alert alert-success" role="alert"> {{session()->get('status')['message']}}</div>
							@else
								<div class="alert alert-danger" role="alert"> {{session()->get('status')['message']}}</div>
							@endif
						@endif
						<div class="form-group">
							<label for="">Email</label>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
							@error('email')
							<div class="invalid-feedback">
								{{$message}}
							</div>
							@enderror 
						</div>
						<div class="form-group">
							<label for="">Password</label>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
							@error('password')
							<div class="invalid-feedback">
								{{$message}}
							</div>
							@enderror 
						</div>
						<button class="submit">LET'S GO</button>
					</form>
				</div>
			</div>
			<div class="right">
				<div class="right-text">
					<h2	>BEEHICLE</h2>
					<h5>YOUR BEEHICLE JOURNAL</h5>
					
				</div>
				<div class="right-inductor"><img src="bacck.jpg" alt="dfadsc"></div>
			</div>
		</div>
	</section>
</body>
</html>