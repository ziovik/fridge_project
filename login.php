<!DOCTYPE html>

<html lang="rus">

<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style type="text/css">
/* DEMO ONLY */
.container .demo{text-align:center;}
.container .demo div{padding:8px 0;}

@media screen and (max-width:900px){.container .demo div{margin-bottom:0;}}
/* DEMO ONLY */
</style>
</head>
<body id="top">

<div class="wrapper row3">
  <main class="hoc container clear "> 
    <!-- main body -->
    <a href="index.php" class="btn" id="btn_ingresar">Back</a>
    
  
    <div class="content "> 
      <div class="group demo">
        <div class="one_third first"></div>
        <div class="one_third">
         	 <div id="comments">
       
		        <h2>Login</h2>
		        <form action="fridges.php" method="post">
		          <div >
	                <label for="email">Login <span>*</span></label>
	                 <input type="email" name="email" id="email" value=""  required>
	               
	              </div>
	              <div >
	                <label for="password">Password <span>*</span></label>
	                <input type="password" name="password" id="password" value=""  required>
	              </div>
		          
		          <div class="block clear">
		            
		          </div>
		          <div>
		             <div class=" one_half first">
		                <input  type="submit" name="submit" value="Submit Form">
		                 &nbsp;
		              </div>
		             <div class=" one_half">
		                <input type="reset" name="reset" value="Reset Form">
		              </div>
		          
		            
		          </div>
		        </form>
      		</div>
          
        </div>
        <div class="one_third"></div>
      </div>
      
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>

</body>
</html>