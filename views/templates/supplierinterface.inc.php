<?php

/*$ordersArray=$model->getOrdersList();
$delivNum=$model->getNotifOrders();
$tommorowsArray=$model->getTommorowsList();
$ingredientsListArray=$model->getIngredientsList();
$commentsArray=$model->getCommentsList();*/


?>


<link rel="stylesheet" type="text/css" href="/CSS/suppliersTable.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    //AJAX Button requests
    $(document).ready(function(){
	
	$( "button" ).click(function() {
            if($(this).hasClass('btn btn-success')){
            alert( "You have accepted this request" );
            var id=$(this).val();
            $.ajax({
            url : "/uiRequests/accept_order.ajax.php", // on donne l'URL du fichier de traitement
            type : "POST", // la requête est de type POST
            data : "id="+id // et on envoie nos données
            });
            }
            
            if($(this).hasClass('btn btn-info')){
            alert( "You are waiting for stock refilling" );
            var id=$(this).val();
            $.ajax({
            url : "/uiRequests/stock_order.ajax.php", // on donne l'URL du fichier de traitement
            type : "POST", // la requête est de type POST
            data : "id="+id // et on envoie nos données
            });
            }

            if($(this).hasClass('btn btn-warning')){
            alert( "You have cancelled the order" );
            var id=$(this).val();
            $.ajax({
            url : "/uiRequests/order_hours.ajax.php", // on donne l'URL du fichier de traitement
            type : "POST", // la requête est de type POST
            data : "id="+id // et on envoie nos données
            });
            }
            
            if($(this).hasClass('btn btn-default navbar-btn')){
            
            var ing=$("#addIng").val().toLowerCase();
          
            if(/[^\w]|[\d]/.test(ing)){
                alert("Please remove all unacceptable characters");
                return;
            }
            alert( "You have added a new ingredient to your ingredients database" );
            var measure=$("#ingMeasure option:selected").text();
            var supplier='<?= $_SESSION['login']; ?>';
            var category=$("#ingCategory option:selected").text();
        
            $.ajax({
            url : "/uiRequests/sup_add_ing.ajax.php", // on donne l'URL du fichier de traitement
            type : "POST", // la requête est de type POST
            data : "addIng="+ing+"&ingMeasure="+measure+"&supplier="+supplier+"&ingCategory="+category // et on envoie nos données
            });
            $("#addField").after("<tr><td>"+ing+"</td><td>"+measure+"</td>"+category+"</tr>").fadeIn();
            
            }
            
            if($(this).hasClass('btn btn-danger')){
                alert( "You have deleted an ingredient from your ingredients database" );
            var id=$(this).val();
            
           
            
            $.ajax({
            url : "/uiRequests/ing_delete.ajax.php", // on donne l'URL du fichier de traitement
            type : "POST", // la requête est de type POST
            data : "id="+id // et on envoie nos données
            });
            $(this).replaceWith('<i style="color:red">Deleted</i>');
            
            
                
                
            }
            
            
            
  	
  	

 

});
});
    
</script>
<script>
    //JQuery : show/hide the element for tommorow
    $(document).ready(function(){
        $('#tommorowButton').on('click',function(){
            
            $('#tommorow').fadeToggle("slow","linear");
        });
                
    });
</script>
<script>
    //JQuery : show/hide the element for ingredients table
    $(document).ready(function(){
        $('#ingredientsButton').on('click',function(){
            
            $('#ingredients_table').fadeToggle("slow","linear");
        });
                
    });


</script>


<diV style="text-align: center;margin-top: 20px; margin-bottom: 20px;">
    
   
 <button class="btn btn-primary" type="button" id='tommorowButton'>
     Tommorows Deliveries <span class="badge"></span>
</button>
    <button class="btn btn-primary" type="button" >
        <a href="#delivs" style="color:white">Deliveries Requests</a> <span class="badge"><?= $delivNum[0][0] ?></span>
    </button>
    
    <button class="btn btn-primary" type="button" id='ingredientsButton'>
  My ingredients <span class="badge"></span>
    </button>
    
</diV>
<diV style="text-align: center;margin-top: 20px; display: none" id="tommorow">
    <ul id="tommorowList">
        <?php 
        if(!empty($tommorowsArray)){
            
        
            foreach ($tommorowsArray as $tomOrder) {
                echo('<li>');
                   echo($tomOrder[0].' '.$tomOrder[1].' '.$tomOrder[2]); 
                echo('</li>');
            }
        }else{
            echo('<p> No order for tommorow... </p>');
            
        }    
        ?>
    </ul>
    
    
</diV>

<div class="span7" id="delivs" >   
<div class="widget stacked widget-table action-table">
    				
				
				
				<div class="widget-content">
					
					<table class="table table-striped table-bordered" id="ingredients_table" style="display:none">
						<thead>
							<tr>
								<th>Ingredient</th>
								<th>Measure</th>
                                <th>Category</th>
                                                                
                                                                
								
							</tr>
						</thead>
                                                <tbody>
                                                    <tr id="addField">
                                                        <td style="align:center">
                                                            
                                                               
                                                            <input id="addIng" placeholder="Add a new ingredient..." style="margin-left: 30%">
                                                            
                                                        </td>
                                                        <td>
                                                            <select id="ingMeasure">
                                                               
                                                                    <option>Kg</option>
                                                                    <option>Tons</option>
                                                                    <option>Bottles(25cl)</option>
                                                                    <option>Box</option>
                                                                    <option>Pieces</option>
                                                                    <option>Kg</option>
                                                                
                                                            </select>
                                                           
                                                        </td>
                                                        <td>
                                                             <select id="ingCategory">
                                                                    
                                                                 <option>other<option>
                                                                    <option>fruits</option>
                                                                    <option>vegetables</option>
                                                                    <option>meat</option>
                                                                    <option>fishes</option>
                                                                    <option>wines</option>
                                                                    <option>soft</option>
                                                                
                                                            </select>
                                                            <button type="button" class="btn btn-default navbar-btn">+</button>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                            foreach ($ingredientsListArray as $ingredient){
                                                    echo('<tr style="text-align:center">');
                                                        echo('<td>'.$ingredient[0].'   <button type="button" class="btn btn-danger" value="'.$ingredient[2].'">X</button></td>');
                                                        echo('<td>'.$ingredient[1].'</td>');
                                                        if($ingredient[3]!=='NULL'){
                                                            echo('<td>'.$ingredient[3].'</td>');
                                                        }else{
                                                            echo('<td>/</td>');
                                                        }
                                                    echo("</tr>");
                                                            }
                                                    ?>        
                                                </tbody>
                                        </table>        
                                </div>                
</div>
</div>
                                
<div>
<div class="span7" id="delivs">   
<div class="widget stacked widget-table action-table">
    				
				<div class="widget-header">
					<i class="icon-th-list"></i>
                                        <div class="alert alert-warning" role="alert"><h5>"ASO" Requests :</h5><p>You can find here every requests received from your clients whom use the ecrodering communicative system</p><strong>"A"</strong>: Accept</br>
                                        <strong>"S"</strong>: Empty stock</br>
                                        <strong>"O"</strong>: Not time enough to deliver in time OR opening hours dont match  </br> Further actions will be avaiable soon, just enjoy the process by now</div>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">

                    <!-- Main table header -->
                    <div class="row">
                      <div id="admin" class="col s12">
                        <div class="card material-table">
                          <div class="table-header">
                            <span class="table-title">Orders table</span>
                            <div class="actions">
                         
                              <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                            </div>
                          </div>
					
					<table id="datatable">
						<thead>
							<tr>
								<th>Delivery</th>
                                <th>ID</th>
								<th>Order</th>
                                <th>Restaurant</th>
                                <th>Comments</th>
                                <th>Status</th>
								
							</tr>
						</thead>
						<tbody>
                                                    <?php foreach ($ordersArray as $order) {
                                                        //0: 
                                                      
                                                        if($order[3]==''){
                                                     echo('<tr>'); 

                                                                if(empty($order[0])){echo('<td style="color:white;background-color:red;">URGENT</td>');}else{echo('<td>'.$order[0].'</td>');}
                                                                echo('<td>'.$order[4].'</td>');
                                                                echo('<td>'.$order[1].'('.$order[5].' '.$order[6].') </td>');
                                                                echo('<td>'.$order[2].'</td>');
                                                                echo('<td>');
                                                                foreach($commentsArray as $comment){
                                                                    if($comment[0]==$order[4]){
                                                                        echo($comment[1]);
                                                                    }
                                                                    
                                                                }
                                                                echo('</td>');
                                                                echo('<td>');
                                                                echo('<button type="button" class="btn btn-success" value="'.$order[4].'">A</button>
                                                                   <button type="button" class="btn btn-info" value="'.$order[4].'">S</button>
                                                                   <button type="button" class="btn btn-warning" value="'.$order[4].'">O</button>
                                                                   ');
                                                                echo('</td>');
                                                     echo('</tr>');
                                                        }elseif($order[3]==='STOCK'){
                                                            echo('<tr>');
                                                            
                                                             if(empty($order[0]) || substr($order[0],0)=="0"){echo('<td style="color:white;background-color:red;">URGENT</td>');}else{echo('<td>'.$order[0].'</td>');}
                                                                echo('<td>'.$order[4].'</td>');
                                                                echo('<td>'.$order[1].'('.$order[5].' '.$order[6].') </td>');
                                                                echo('<td>'.$order[2].'</td>');
                                                                echo('<td>');
                                                                echo('<button type="button" class="btn btn-success" value="'.$order[4].'">A</button>
                                                                   <i>Stock pending</i>');
                                                                echo('</td>');
                                                            
                                                            echo('</tr>');
                                                        }else{
                                                          echo('<tr>');
                                                                if(empty($order[0]) || substr($order[0],0)=="0"){echo('<td style="color:white;background-color:red;">URGENT</td>');}else{echo('<td>'.$order[0].'</td>');}
                                                                echo('<td>'.$order[4].'</td>');
                                                                echo('<td>'.$order[1].'('.$order[5].' '.$order[6].') </td>');
                                                                echo('<td>'.$order[2].'</td>');
                                                                echo('<td>');
                                                                foreach($commentsArray as $comment){
                                                                    if($comment[0]==$order[4]){
                                                                        echo($comment[1]);
                                                                    }
                                                                }
                                                                echo('</td>');
                                                                echo '<td style="color:green"> Accepted </td>';
                                                                
                                                          echo('</tr>');
                                                        }
                                                    } ?>
							
							</tbody>
						</table>
                        </div>
                    </div>
                </div>
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->
            </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
<script src="/views/template/suppliersTable.js"></script>



