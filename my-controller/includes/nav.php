 <div class="nav_container">
     <div class="nav-image">
         <a href="index.php"><img src="images/home.png" alt="Home" title="Admin Home" /></a>
     </div>
     <div class="nav-title">
         <a href="index.php">Home</a>
     </div>
 </div>
 <div class="nav_container">
     <div class="nav-image">
         <a href="javascript:void(0)"><img src="images/user.png" alt="Home" title="Admin Home" /></a>
     </div>
     <div class="nav-title">
         <?php echo $user_obj->get_current_admin(); ?>
     </div>
 </div>
 <div class="nav_container">
     <?php 
        if(ENV=="development"){
     ?>
     <div class="nav-image">
         <a href="javascript:void(0)"><img src="images/options.png" alt="Home" title="Logger" /></a>
     </div>
     <div class="nav-title">
         <a href="javascript:void(0)" id="variable_logger">Variable Logger</a>
     </div>
     <?php } ?>
 </div>
 <div class="nav_container">
     <?php 
        if(ENV=="development"){
     ?>
     <div class="nav-image">
         <a href="javascript:void(0)"><img src="images/gear.png" alt="Home" title="Logger" /></a>
     </div>
     <div class="nav-title">
         <a href="javascript:void(0)" id="variable_logger">Developer Option</a>
     </div>
     <div class="nav_popup">
         <div class="arrow-up"></div>
         <div class="nav_popup_container">
             <div class="nav-image">
                 <a href="?page=exportdb"><img src="images/gear.png" alt="Home" title="Export Database" /></a>
             </div>
             <div class="nav-title">
             <a href="?page=exportdb">Export Database</a>
             </div>
         </div>
         <div class="nav_popup_container">
             <div class="nav-image">
                 <a href="javascript:void(0)"><img src="images/gear.png" alt="Home" title="Logger" /></a>
             </div>
             <div class="nav-title">
             <a href="javascript:void(0)">Export Project</a>
             </div>
         </div>
         <div class="nav_popup_container">
             <div class="nav-image">
                 <a href="?page=codemirror"><img src="images/gear.png" alt="Home" title="Logger" /></a>
             </div>
             <div class="nav-title">
             <a href="?page=codemirror">Program Files</a>
             </div>
         </div>
         
     </div>
     <?php } ?>
 </div>
 <div class="nav_container" style="float:right; position:relative;">
     <div class="nav-image">
         <a href="javascript:void(0)" id="colorSelector" class="colorSelector">
             &nbsp;
         </a>
     </div>
     <div class="nav-color-selector">
         <a href="javascript:void(0)" class="select-color" style="background-color: #A60000;">
             &nbsp;
         </a>
         <a href="javascript:void(0)" class="select-color" style="background-color: #AEBC2F;">
             &nbsp;
         </a>
         <a href="javascript:void(0)" class="select-color" style="background-color: #207F60;">
             &nbsp;
         </a>
         <a href="javascript:void(0)" class="select-color" style="background-color: #BF7830;">
             &nbsp;
         </a>
         <a href="javascript:void(0)" class="select-color selected-color" style="background-color: #66a1d2;">
             &nbsp;
         </a>
     </div>
 </div>
 <div class="nav_container">
     <div class="nav-image">
         <a href="javascript:void(0)"><img src="images/Lock.png" alt="Logout" title="Logout" /></a>
     </div>
     <div class="nav-title">
         <a href="?page=logout">Logout</a>
     </div>
 </div>
 

