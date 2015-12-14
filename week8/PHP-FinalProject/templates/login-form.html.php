<h1>Photo Log-In<small></small></h1>
   <form action="#" method="post" > 
   <div class="form-group">
           <label  class="sr-only" for="email">Email address</label>
           <div class="input-group"> 
               <input type="text" class="form-control" id="email" placeholder="Email"
                      name="email" value="<?php echo $email; ?>">  <br/>  
           </div>
   </div>      
   <div class="form-group">
           <label class="sr-only" for="password">Password</label>     
           <div class="input-group">    
               <input type="password" class="form-control" id="password" placeholder="Password"
                      name="password" value="">  <br/>
           </div>
   </div>
   <input type="submit" value="submit" class="btn btn-primary" />

   </form>