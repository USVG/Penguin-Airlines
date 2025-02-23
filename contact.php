<?php
include "ifSessionHeader.php";

 ?>

 <div class="container">

   <div class="row">

     <!-- Article main content -->
     <article class="col-sm-9 maincontent">
       <header class="page-header">
         <br><h1 class="page-title">Contact us</h1>
       </header>

       <p>
         Do you have a query or question you need answered? Fill out the form below and we will get back to you as soon as we can.
       </p>
       <br>
         <form>
           <div class="row">
             <div class="col-sm-4">
               <input class="form-control" type="text" placeholder="Name">
             </div>
             <div class="col-sm-4">
               <input class="form-control" type="text" placeholder="Email">
             </div>
             <div class="col-sm-4">
               <input class="form-control" type="text" placeholder="Phone">
             </div>
           </div>
           <br>
           <div class="row">
             <div class="col-sm-12">
               <textarea placeholder="Type your message here..." class="form-control" rows="9"></textarea>
             </div>
           </div>
           <br>
           <div class="row">
             <div class="col-sm-6">

             </div>
             <div class="col-sm-6 text-right">
              <input class="btn btn-action" type="submit" value="Submit Form">
             </div>
           </div>
         </form>

     </article>
     <!-- /Article -->

     <!-- Sidebar -->
     <aside class="col-sm-3 sidebar sidebar-right">

       <div class="widget">
         <br><h4>Address:</h4>
         <address>
           234 Hidden Road, Huddersfield, England HD4 5JO
         </address>
         <h4>Phone:</h4>
         <address>
           +447128 123845
         </address>
       </div>

     </aside>
     <!-- /Sidebar -->

   </div>
 </div>
 <br><br><br><br><br><br><br>

	<?php
  include "footer.php";
  ?>
