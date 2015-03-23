<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>	
	
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Invoice Report</h1>

	<div>
		<?php 
		//Open form
		$attributes = array('id' => 'report_form');
		echo form_open('report/generate_report',$attributes);
		
		//Create client dropdown
		echo form_label('Select Client/Company :');
		echo form_dropdown('client', $client, 'large');
		
		//Create date dropdown
		echo form_label('Select Dates :');
		echo form_dropdown('dates', $dates, 'large');
		
		
		echo form_label('Select products :');
		echo form_dropdown('products', array(), 'large');
		
		//Create submit button
		echo form_button('go', 'Submit','class="submit"');
		
		echo form_close();
		
		?>
		
	</div>
		<hr />
		<div id="result">
			
		</div>
	
</div>
<script>

	$(document).ready(function(){
		//On click of submit button call ajax and fetch all available results
		$(".submit").click(function(){
			//Fetch values of client and date dropdown
			params = $( "#report_form" ).serialize();
			//Prepare url variable
			url = $('#report_form').attr('action');
			
			//make ajax call to get all records
			$.post(url,params,function(resp){
				//Display results in result div.
				$("#result").html(resp);

			});
		});

		
		//Fill clients product when client drop down is changed
		$("select[name=client]").change(function(){
			//make ajax call for fetching products of selected client
			$.post('<?php echo site_url('report/get_client_products');?>',{client:$(this).val()},function(resp){
				//decode json response
				options = $.parseJSON(resp);
				//Remove all products options from old client
				$("select[name=products] option").remove();
				
				//Fill new client's products
				$.each(options, function (i, item) {
					$('select[name=products]').append($('<option>', { 
						value: item.key,
						text : item.value 
					}));
				});
			});
		});
		
	});
</script>
</body>
</html>