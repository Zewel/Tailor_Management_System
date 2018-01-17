<?php
include "db_connection.php";
session_start();
$user=$_SESSION['user_name'];
if (!($_SESSION['user_name'] && $_SESSION['password'])) {
	
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>
<!-- Mirrored from www.bublinastudio.com/flattybs3/form_styles.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Sep 2015 15:13:05 GMT -->
<head>
    <title>Order | Tailor Management System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    <meta content='Flat administration template for Twitter Bootstrap. Twitter Bootstrap 3 template with Ruby on Rails support.' name='description'>
    <link href='assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
	<link rel="stylesheet"href="css/style.css"type="text/css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- / START - page related stylesheets [optional] -->
    
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body class='contrast-red '>
    <?php include'headerdb.php'?>
    <div id='wrapper'>
      <div id='main-nav-bg'></div>
      <?php include "manue.php";?>
   <section id='content'>
    <div class='container'>
        <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>
                        <div class='icon-edit'></div>
                        Order
                      </div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
						<form class='form'method="post"action="" style='margin-bottom: 0;'>
							<fieldset>
									<div class="row">
										<div class="col-md-6">
											<div class='form-group'>
												<label class='control-label col-md-3'>Mobile No.</label>
												<div class='col-md-7'>
												  <input class='form-control' name="Mobile_No" type="text" id="Mobile_No" size="20"/>
												</div>
											</div><br><br>
											<div class='form-group'>
												<label class='control-label col-md-3'>Customer Name</label>
												<div class='col-md-7'>
												  <input class='form-control' type="text" id="Customer_Name" name="Customer_Name" required/>
												</div>
											</div><br><br>
											<div class='form-group'>
												<label class='control-label col-md-3'>Address</label>
												<div class='col-md-7'>
												  <input class='form-control' id='address_txt'name='address_txt'type='text'>
												</div>
											</div><br><br>
											<div class='form-group'>
												<label class='control-label col-md-3'>Email</label>
												<div class='col-md-7'>
												  <input class='form-control' id='email_txt'name='email_txt'type='email'>
												</div>
											</div><br><br>
											
											<div class='form-group'>
												<div class='col-md-7'>
													<input id= "Delivery_Qt"   class='form-control' type="hidden" name="rate" value="0"  />
												</div>
											</div><br><br>
										</div>
										<div class="col-md-6">
											<div class='form-group'>
												<label class='control-label col-md-3'>Order Date</label>
												<div class='col-md-7'>
												  <div class='datepicker-input input-group'>
													  <input class='form-control'type="date" id="order_date" name="order_date" data-format='YYYY-MM-DD' placeholder='yyyy/mm/dd'>
													  <span class='input-group-addon'>
														<span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
													  </span>
												  </div>
												</div>
											</div><br><br>
											<div class='form-group'>
												<label class='control-label col-md-3'>Delivery Date</label>
												<div class='col-md-7'>
												  <div class='datepicker-input input-group'>
												  <input class='form-control'type="date" id= "delivery_date" name="delivery_date"data-format='YYYY-MM-DD' placeholder='yyyy/mm/dd'>
												  <span class='input-group-addon'>
													<span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
												  </span>
												</div>
												</div>
											</div><br><br>
											<div class="content-border">
												<div class='form-group'>
													<label class='control-label col-md-3'>Product</label>
													<div class='col-md-7'>
													<?php
														$result = $conn->query("select ProductID , ProductName from productinfo");
														echo "<select class='form-control'id= 'product' name='product'>";
														echo "<option hidden >Select Product</option>";
														while ($row = $result->fetch_assoc()) {
														$id = $row['ProductID'];
														$name = $row['ProductName'];
														echo '<option value="'.$id.'">'.$name.'</option>';
														}
														echo "</select>";
													?>										
													</div>
												</div><br><br>
												<div class='form-group'>
													<label class='control-label col-md-3'>Quantity</label>
													<div class='col-md-7'>
														<input class='form-control'id="quantity" type="text" name="quantity"/>	
													</div>
												</div><br><br>
												<div class='form-group'>
													<label class='control-label col-md-3'>Rate</label>
													<div class='col-md-7'>
													  <input class='form-control'id='rate' name='rate'type='text'>
													</div>
												</div><br><br>
											</div>
										</div>
									</div>
							</fieldset>
							<div  align = "right">
									<button type= "button" name = "Add" id = "add" class = "btn btn-info "> ADD</button>
							</div>
							<div class= "container-fluid">
								<div class="row ">	
									<div class=" col-md-6">
										<br/>
										<div class= "table-responsive">
											<table width="100%" class= "table table-bordered" id= "table_List">
												<tr>
													<th>Product name</th>
													<th>Product Quantity</th>
													<th>Product Rate</th>
													<th>Delivery Quantity</th>
													<th></th>
												</tr>
											</table>
										</div>
									</div>
									<div class="col-md-6">
									<br>
										<table width="100%"class= "table table-bordered"id= "component_tbl">					
										<tr>
											<th width = "50%">Component</th>
											<th width = "50%">Size</th>								
										</tr>					
									</table>
									</div>
								</div>
								<div class="row">
									<div class= "table-responsive">
										<table style='display:none';  class= "table table-bordered" id= "table_List1" >
											<tr>
												<th width = "10%">Component</th>
												<th width = "10%">Size</th>
												<th width = "5%"></th>
											</tr>
										</table>
									</div>
								</div>
								<div  align = "center">
									<button type= "button" name = "submit" id = "submit" class = "btn btn-info "> Save</button> 
								</div>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
	  <footer id='footer'>
		<div class='footer-wrapper'>
		  <div class='row'>
			<div class='col-sm-6 text'>
			  <!-- Copyright © 2017 DSL-->
			</div>
		  </div>
		</div>
	  </footer>
        </div>
      </section>
    </div>
    <!-- / jquery [required] -->
	<script>
$(document).ready(function(){

	var count = 1;
	
	$('#add').click(function(){
	
		count= count+1;
		var product = document.getElementById("product").value ;
		var quantity = document.getElementById("quantity").value ;
		var rate = document.getElementById("rate").value ;
		var delivery_Qty=document.getElementById("Delivery_Qt").value;
		
		var html_code = "<tr  id='row"+count+"'>";

		html_code += "<td contenteditable='true' class='product_Name'>"+product+"</td>";
		html_code += "<td contenteditable='true' class='product_Quantity'>"+quantity+"</td>";
		html_code += "<td contenteditable='true' class='product_Rate'>"+rate+"</td>";
		html_code += "<td contenteditable='false' class='delivery_Qty'>"+delivery_Qty+"</td>";
		html_code += "<td><button type= 'button' name='remove' id='remove'  data-row= 'row "+count+"' class= 'btn btn-danger btn-xs remove'>-</button></td>";
					  
		html_code += "</tr>"; 
		$('#table_List').append(html_code);
		
		 $('#component_tbl .clstrRow').each(function(){
			$("#table_List1").append($(this)); //append to any new table
			});
	});
	  $('#submit').click (function (){
		var product_Name= [];
		var product_Quantity= [];
		var product_Rate= [];
		//var order_ID=[];
		var delivery_Qty=[];
		var component_val=[];
		var component_Size=[];
			
		$('.product_Name').each(function(){
			product_Name.push($(this).text());
		});
		$('.product_Quantity').each(function(){
			product_Quantity.push($(this).text());
		});
		 
		$('.product_Rate').each(function(){
			product_Rate.push($(this).text());
		}); 
		 
		$('.delivery_Qty').each(function(){
			delivery_Qty.push($(this).text());
		}); 
		$('.component_val').each(function(){
			component_val.push($(this).text());
		});
		$('.component_Size').each(function(){
			component_Size.push($(this).text());
		});
	$ .ajax({
			
			url:"insertdatatable.php",
			method:"POST",
			data:{
				'Customer_Name'		: $("#Customer_Name").val(),
				'mobile_NO'			: $("#Mobile_No").val(),
				'customer_Address'	: $("#address_txt").val(),
				'email_txt'			: $("#email_txt").val(),
				'orderDate' 		: $("#order_date").val(),
				'deliveryDate'		: $("#delivery_date").val(),
				product_Name:product_Name,product_Quantity:product_Quantity,delivery_Qty:delivery_Qty,product_Rate:product_Rate,component_val:component_val,component_Size:component_Size},
			
			success: function(data)
			{
				alert (data);
				$("td[contenteditable= 'true']").text("");
				$("td[contenteditable= 'false']").text("");
				window.location.reload(); 
			}
		}); 
	 });
	 $('#product').change(function(){
		 //$("#Component_tbl").show();
		 jQuery('#Component_tbl').hide(false);
		 $('#component_tbl .clstrRow').html('');
	var Category = $(this).find('option:selected').attr('value');   
		$.ajax({
				data:{'Catgy':Category},
				url:'OrderDropdown.php',
				success:function(data){
					//alert (data);
					$.each(JSON.parse(data), function (index, item) {
					 var eachrow = "<tr class='clstrRow'>"
								 //+ "<td value=' productCode'>"+Category+"</td>"
								 + "<td value='item.PCID' class='component_Name'>" + item.Component + "</td>"
								 + "<td style='display:none;' class='component_val'>" + item.PCID  + "</td>"
								 + "<td Contenteditable='true' class='component_Size'></td>"
								 + "</tr>";
					 $('#component_tbl').append(eachrow);					
					});
					}
				});
			}); 
	}); 
</script>
    <script src="assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- / jquery mobile (for touch events) -->
    <script src="assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
    <!-- / jquery migrate (for compatibility with new jquery) [required] -->
    <script src="assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- / jquery ui -->
    <script src="assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
    <script src="assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <script src="assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
    <!-- / modernizr -->
    <script src="assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
    <!-- / retina -->
    <script src="assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="assets/javascripts/plugins/bootstrap_colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <script src="assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
    <script src="assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
    <script src="assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
    </body>
<!-- Mirrored from www.bublinastudio.com/flattybs3/form_styles.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Sep 2015 15:13:05 GMT -->
</html>
