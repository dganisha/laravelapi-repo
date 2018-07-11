<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel API Doc</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  </head>
  <body>
    
    <div class="container">
    	<h2>Laravel API Request</h2>

		{{-- List Tasks --}}
{{-- Helpers :: tesHelper () --}}
		<div class="row">
			<div class="col-md-5">
				<h3>API Request Register</h3>
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr class="table-header">
									<th colspan="4">
										Request Endpoint
									</th>
								</tr>
								<tr>
									<th>
										Endpoint:
									</th>
									<td>
										127.0.0.1/api/register
									</td>
								</tr>
								<tr>
									<th>
										Method:
									</th>
									<td>
										POST
									</td>
								</tr>
								<tr class="table-header">
									<th colspan="4">
										Parameters
									</th>
								</tr>
								</tr>
				                <tr>
					                  <th>Name</th>
					                  <th>Location</th>
					                  <th>Value</th>
				                </tr>
								<tr>
									<th>
										Content-Type
									</th>
									<td>
										Headers
									</td>
									<td>
										application/x-www-form-urlencoded
									</td>
								</tr>
								<tr>
									<th>
										Accept
									</th>
									<td>
										Headers
									</td>
									<td>
										application/json
									</td>
								</tr>
								<tr>
									<th>
										Authorization
									</th>
									<td>
										Headers
									</td>
									<td>
										Bearer {your token}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</div>
		</div>
{{--		<div class="col-md-3">
				<ul class="list-group">			
						<li class="list-group-item">
								<b>a</b> - b - c
								<div class="pull-right">
									<a href="#">Edit</a>
								</div>
						</li>
				</ul>
			</div> --}}

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
  </body>
</html>