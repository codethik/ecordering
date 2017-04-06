<?php $suppliersListArray=$model->getSuppliersList();
$ingredientsListArray=$model->getIngredients();
$ordersListArray=$model->getOrdersList(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<head>
	<link rel="stylesheet" type="text/css" href="views/templates/cooktabs/cook_tab_style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
        <script href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
              
              
              
              
        </script>
        <script>
            	
// AJAX -- Add an ingredient in BDD //  
$(document).ready(function(){
	
	$('button').click(function() {
    //add ingredient
            if($(this).hasClass('btn btn-success')){
                alert( "Handler for .click() called."+"<?= $_SESSION['login']?>" );
                      var ing_id = encodeURIComponent( $(this).attr('id') ); // on sécurise les données
                      var ing_name = encodeURIComponent( $(this).val() );
                      var cookSender ="<?= $_SESSION['login'] ?>"
                      alert(ing_id + ing_name);


                  if(ing_id != "" && cookSender != ""){ // on vérifie que les variables ne sont pas vides
                      $.ajax({
                          url : "../uiRequests/ing_add.ajax.php", // on donne l'URL du fichier de traitement
                          type : "POST", // la requête est de type POST
                          data : "ing_id=" + ing_id + "&cookName=" + cookSender // et on envoie nos données
                      });
                      $(this).replaceWith('<button class="btn btn-warning" id="'+ing_id+'" value="'+ing_name+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>');
                      $("#ing_message td").text(ing_id+" added! it will apprear when the page will be reloaded");
                      $("#ing_datas").append('<option id="'+ing_name+'">'+ing_name+'</option>');
                      };
           }
           if($(this).hasClass('btn btn-warning')){
                      var ing_id = encodeURIComponent( $(this).attr('id') ); // on sécurise les données
                      var ing_name = encodeURIComponent( $(this).val() );
                      if(ing_id != "" && cookSender != ""){ // on vérifie que les variables ne sont pas vides
                      $.ajax({
                          url : "../uiRequests/ing_delete.ajax.php", // on donne l'URL du fichier de traitement
                          type : "POST", // la requête est de type POST
                          data : "ing_id=" + ing_id // et on envoie nos données
                      });
                      $('#'+ing_name).remove();
                    }
         }
         if($(this).hasClass('btn btn-info')){
                      var ing1 = encodeURIComponent( $('input[name="ing1"]').val() ); // on sécurise les données
                      var qty1 = encodeURIComponent( $('input[name="qty1"]').val() );
                      var delivDate = encodeURIComponent( $('input[name="delivDate"]').val() );
                      var comment1 = encodeURIComponent( $('input[name="comment1"]').val() );
                      
                      alert(ing1);
                      alert(qty1);
                      alert(delivDate);
                      alert(comment1);
                      
                      if(ing1 !== "" && qty1 !== ""){ // on vérifie que les variables ne sont pas vides
                      $.ajax({
                          url : "../uiRequests/ing_cook_order.ajax.php", // on donne l'URL du fichier de traitement
                          type : "POST", // la requête est de type POST
                          data : "ing1=" + ing1 + "&qty1=" + qty1 + "&deliv1=" + delivDate +"&comment1="+ comment1// et on envoie nos données
                      });
                    
                    }
                    $('input[name="ing1"]').val('');
                    $('input[name="qty1"]').val('');
                    $('input[name="comment1"]').val('');
                    $('#addField').children().remove();
                    $('#addField').append('<td colspan="2" style="color:green;text-align:center">stauts: order sent ! you can send another order</td>');
                    setTimeout(function(){   
                            
                         $('#addField').children().remove();
                        $('#addField').append('<td colspan="2" style="color:burlywood;text-align:center">status: waiting for order</td>');  
                        
                    }, 5000);
         }
         
           
        });
        
        $('tr').click(function(){
            
            if($(this).hasClass('cookOrders')){
                $commentOrderId=$(this).attr("id");
                var comment='';
                                 $.post(
                                        '../uiRequests/com_cook.ajax.php', // Un script PHP que l'on va créer juste après
                                        {
                                           id : $commentOrderId   // Nous récupérons la valeur de nos input que l'on fait passer à connexion.php
                                            
                                        },

                                        function(data){

                                           comment=data;
                                           

                                        },

                                        'json'
                                     );

                                     
                                     
                                     var saveThis=$(this);    
                                     var lineOfOrders='';
                                     for(var line in comment){
                                         lineOfOrders.concat('<tr class="commentField" style="background-color:#D1E2E8;"><td>'+line[0]+'</td><td>'+line[1]+'</td><td>'+line[2]+'</td></tr>');
                                         
                                     }
                                     
                setTimeout(function(){  
                    for(i=0;i<=comment.length-1;i++){
                        var status;
                        comment[i][4]==""?status="<i style='color:red'>WAITING</i>":status="CLEARANCE";                
                        saveThis.after('<tr class="commentField" style="background-color:#D1E2E8;"><td class="commentField"><i style="color:green">    </i>  '+comment[i][0]+'  </td><td>'+comment[i][1]+'('+comment[i][2]+')</td><td>'+comment[i][3]+'</td><td>'+status+'</td></tr>'); 
                    }            //saveThis.after('<tr class="commentField" style="background-color:#D1E2E8;"><td class="commentField" colspan="4"><i style="color:green">      you : </i>  '+comment+'  </td></tr>');
                    saveThis.next().hide().fadeIn(1800);
             
               },500);       
              saveThis.next().click(function(){
                    
                    saveThis.fadeOut(1800);
                    
               });
            
          
                }
                if($(this).hasClass("commentField")){
                    $(this).remove();
                }  
        });
        
        
            
});	


 </script>
 
       
</head>
<body>
    <div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Beta Version: </strong> If you have any comment about the application, please, feel free to contact us : <a href="mailto:contact@ecordering.be">support mail</a>
</div>
	<div class="container theme-plum">
	
  <div class="ui-tabgroup">
    <input class="ui-tab1" type="radio" id="tgroup_a_tab1" name="tgroup_a" checked />
    <input class="ui-tab3" type="radio" id="tgroup_a_tab3" name="tgroup_a" />
    <input class="ui-tab2" type="radio" id="tgroup_a_tab2" name="tgroup_a" />
    

    <div class="ui-tabs">
      <label class="ui-tab1" for="tgroup_a_tab1"><i class="fa fa-check-square-o"></i>Orderings status</label>
      <label class="ui-tab3" for="tgroup_a_tab3"><i class="fa fa-shopping-basket"></i>Market</label>
      <label class="ui-tab2" for="tgroup_a_tab2"><i class="fa fa-puzzle-piece"></i>add new order</label>
      
      

    </div>
    <div class="ui-panels">
      <div class="ui-tab1">
        	<div id="cook_ordering_status">
        		<style scoped>
        		
            div.material-table {
  padding: 0;
}

div.material-table .hiddensearch {
  padding: 0 14px 0 24px;
  border-bottom: solid 1px #DDDDDD;
  display: none;
}

div.material-table .hiddensearch input {
  margin: 0;
  border: transparent 0 !important;
  height: 48px;
  color: rgba(0, 0, 0, .84);
}

div.material-table .hiddensearch input:active {
  border: transparent 0 !important;
}

div.material-table table {
  table-layout: fixed;
}

div.material-table .table-header {
  height: 64px;
  padding-left: 24px;
  padding-right: 14px;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  display: flex;
  -webkit-display: flex;
  border-bottom: solid 1px #DDDDDD;
}

div.material-table .table-header .actions {
  display: -webkit-flex;
  margin-left: auto;
}

div.material-table .table-header .btn-flat {
    min-width: 36px;
    padding: 0 8px;
}

div.material-table .table-header input {
  margin: 0;
  height: auto;
}

div.material-table .table-header i {
  color: rgba(0, 0, 0, 0.54);
  font-size: 24px;
}

div.material-table .table-footer {
  height: 56px;
  padding-left: 24px;
  padding-right: 14px;
  display: -webkit-flex;
  display: flex;
  -webkit-flex-direction: row;
  flex-direction: row;
  -webkit-justify-content: flex-end;
  justify-content: flex-end;
  -webkit-align-items: center;
  align-items: center;
  font-size: 12px !important;
  color: rgba(0, 0, 0, 0.54);
}

div.material-table .table-footer .dataTables_length {
  display: -webkit-flex;
  display: flex;
}

div.material-table .table-footer label {
  font-size: 12px;
  color: rgba(0, 0, 0, 0.54);
  display: -webkit-flex;
  display: flex;
  -webkit-flex-direction: row
  /* works with row or column */
  
  flex-direction: row;
  -webkit-align-items: center;
  align-items: center;
  -webkit-justify-content: center;
  justify-content: center;
}

div.material-table .table-footer .select-wrapper {
  display: -webkit-flex;
  display: flex;
  -webkit-flex-direction: row
  /* works with row or column */
  
  flex-direction: row;
  -webkit-align-items: center;
  align-items: center;
  -webkit-justify-content: center;
 justify-content: center;
}

div.material-table .table-footer .dataTables_info,
div.material-table .table-footer .dataTables_length {
  margin-right: 32px;
}

div.material-table .table-footer .material-pagination {
  display: flex;
  -webkit-display: flex;
  margin: 0;
}

div.material-table .table-footer .material-pagination li:first-child {
  margin-right: 24px;
}

div.material-table .table-footer .material-pagination li a {
  color: rgba(0, 0, 0, 0.54);
}

div.material-table .table-footer .select-wrapper input.select-dropdown {
  margin: 0;
  border-bottom: none;
  height: auto;
  line-height: normal;
  font-size: 12px;
  width: 40px;
  text-align: right;
}

div.material-table .table-footer select {
  background-color: transparent;
  width: auto;
  padding: 0;
  border: 0;
  border-radius: 0;
  height: auto;
  margin-left: 20px;
}

div.material-table .table-title {
  font-size: 20px;
  color: #000;
}

div.material-table table tr td {
  padding: 0 0 0 56px;
  height: 48px;
  font-size: 13px;
  color: rgba(0, 0, 0, 0.87);
  border-bottom: solid 1px #DDDDDD;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

div.material-table table tr td a {
  color: inherit;
}

div.material-table table tr td a i {
  font-size: 18px;
  color: rgba(0, 0, 0, 0.54);
}

div.material-table table tr {
  font-size: 12px;
}

div.material-table table th {
  font-size: 12px;
  font-weight: 500;
  color: #757575;
  cursor: pointer;
  white-space: nowrap;
  padding: 0;
  height: 56px;
  padding-left: 56px;
  vertical-align: middle;
  outline: none !important;
}

div.material-table table th.sorting_asc,
div.material-table table th.sorting_desc {
  color: rgba(0, 0, 0, 0.87);
}

div.material-table table th.sorting:after,
div.material-table table th.sorting_asc:after,
div.material-table table th.sorting_desc:after {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 16px;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  display: inline-block;
  word-wrap: normal;
  -webkit-font-feature-settings: 'liga';
  -webkit-font-smoothing: antialiased;
  content: "arrow_back";
  -webkit-transform: rotate(90deg);
  display: none;
  vertical-align: middle;
}

div.material-table table th.sorting:hover:after,
div.material-table table th.sorting_asc:after,
div.material-table table th.sorting_desc:after {
  display: inline-block;
}

div.material-table table th.sorting_desc:after {
  content: "arrow_forward";
}

div.material-table table tbody tr:hover {
  background-color: #EEE;
}

div.material-table table th:first-child,
div.material-table table td:first-child {
  padding: 0 0 0 24px;
}

div.material-table table th:last-child,
div.material-table table td:last-child {
  padding: 0 14px 0 0;
}
            </style>

    
    
    
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>



    <div class="row">
  <div id="admin" class="col s12">
    <div class="card material-table">
      <div class="table-header">
        <span class="table-title"></span>
        <div class="actions">
          <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i>Search</a>
        </div>
      </div>
      <table id="datatable">
        <thead>
          <tr>
            <th> ID </th>
            <th></th>
            <th>delivery</th>
            
          </tr>
        </thead>
        <tbody>
          <?php foreach($ordersListArray as $order){
              echo('<tr class="cookOrders" id="'.$order[2].'">');
              echo('<td>');
                $idOrder=$order[0];
                echo($order[0]);
                
              echo('</td>');
              echo('<td></td>');
              if(($order[2])==='0000-00-00'){
                  echo('<td style="color:red">ASAP</td>');
              }else{
                  echo('<td>'.$order[2].'</td>');
              }
               
              echo('</tr>');
              
       
              
          }?>
        </tbody>
      </table>
        
    </div>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>

       <script src="views/templates/cooktabs/js/index.js"></script>

    
    
    
 

        	</div>
      </div>
        
 <!--  ##############################################  SEND AN ORDER PAGE -->       
        
      <div class="ui-tab2">
          <div class="row">
  <div id="admin" class="col s12">
    <div class="card material-table">
      <div class="table-header">
         <!--  <form id="new_order" name="new_order" method="POST" action="index.php?action=SendCookOrder"> -->
          <span class="table-title" description="eg. 31/02/2016"><label>Delivery date(eg:31/02/2016) :</label><input name='delivDate' placholder="eg. 31/02/2016" type="date"></span>
        <div class="actions">
         
        </div>
      </div>
      <table id="datatable">
        <thead>
          <tr>
            <th>ingredient</th>
            <th>quantity</th>           
          </tr>
        </thead>
        <tbody>
          <tr>
              <td>
                <datalist id="ing_datas" >
                  <?php foreach($ingredientsListArray as $ingredient){
                echo('<option>'.$ingredient[0].'</option>');
            } ?> 
                </datalist>
                <datalist id="measures">
                  <option value="Kg">
                  <option value="Piece">  
                  <option value="L">
                  <option value="Bottles(25cl)">
                  <option value="Bottles(50cl)">
                  <option value="Bottles(1L)">  
                </datalist>
                  
                  <input list="ing_datas" type="text" name="ing1" placeholder="Type the first letters from an ingredient..." required>
              </td>
              <td style="color:green">
                  <input type="number" name="qty1" placeholder="... And sert the quantity" required>
              </td>
          </tr>
          <tr>
              <td colspan="2" style="text-align:center"><input type="text" name="comment1" placeholder="insert a comment (optional)"></td>
          </tr>
        
          <tr id="addField">
              <td colspan="2" style="text-align:center;color:burlywood" >Status : Waiting for order</td>
          </tr>
          <tr colspan="1">
              <td></td>
              <td style="text-align:center;"><button class="btn btn-info" value="Order now" >Order</button></td>
            
           <!-- </form>   -->
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
        
      </div>
 
 <!-- Add a new ingredient --> 
      <div class="ui-tab3">
                  <div class="row">
  <div id="admin" class="col s12">
    <div class="card material-table">
      <div class="table-header">
        <span class="table-title"></span>
        
      </div>
      <table id="datatable">
          <thead>
              <tr><th>Ingredient</th><th>Suppliers</th><th>Measures</th></tr>
          </thead>
          <tbody>
              <?php
               foreach ($ingredientsListArray as $ingredient){
              
                   echo('<tr><td>'.$ingredient[0].'</td><td>'.$ingredient[1].'</td><td>'.$ingredient[2].'</td></tr>');
               } ?>       
          </tbody>
      </table>
    </div>
  </div>
</div>
</div>
          <!--############################   suppliers list   ################################ -->
      </div>
     
    </div>
  </div>
 </div> 
  
</body>	
