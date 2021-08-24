<!DOCTYPE html>
<!-- Designined by CodingLab - youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> LegaShop | Shopping Details </title>
    <link rel="stylesheet" href="{{ asset('beneficiary_assets/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" integrity="sha512-AFwxAkWdvxRd9qhYYp1qbeRZj6/iTNmJ2GFwcxsMOzwwTaRwz2a/2TX225Ebcj3whXte1WGQb38cXE5j7ZQw3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>	
  </head>
<body>
  <div class="container">
          <div class="title">Details of your Shopping <span style="color: crimson; font-size: 15px;">* Required Form</span></div>
    <div class="content">
      <form action="{{ url('/add_beneficiary_info') }}" method="POST">
      {{ csrf_field() }}
        <!-- beneficiary info -->
          <div class="user-details">
            <input type="text" name="user_id" value="{{ $currentUser->id }}" hidden>
            <div class="input-box">
              <span class="details">Beneficiary Name</span>
              <input type="text" name="beneficiary_name" placeholder="Enter name" required>
            </div>
            <div class="input-box">
              <span class="details">Relationship</span>
              <input type="text" name="relationship" placeholder="Enter relationship" required>
            </div>
            <div class="input-box">
              <span class="details">Email</span>
              <input type="text" name="email" placeholder="Enter email" required>
            </div>
            <div class="input-box">
              <span class="details">Phone Number</span>
              <input type="text" name="phone_number" placeholder="Enter number" required>
            </div>
          </div>

        <!-- regions -->
          <div class="gender-details">
          <input type="radio" name="region_chosen" value="Ilocos Region" id="dot-1">
          <input type="radio" name="region_chosen" value="Cagayan Valley" id="dot-2">
          <input type="radio" name="region_chosen" value="Central Luzon" id="dot-3">
          <input type="radio" name="region_chosen" value="CALABARZON" id="dot-4">
          <input type="radio" name="region_chosen" value="MIMAROPA" id="dot-5">
          <input type="radio" name="region_chosen" value="Bicol" id="dot-6">
          <input type="radio" name="region_chosen" value="CAR" id="dot-7">
          <input type="radio" name="region_chosen" value="NCR" id="dot-8">
          <span class="gender-title">Region <span style="color: crimson; font-size: 15px;">*region of desired store to shop</span></span>
          <div class="category">
            <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Ilocos Region</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Cagayan Valley</span>
            </label>
            <label for="dot-3">
              <span class="dot three"></span>
              <span class="gender">Central Luzon</span>
            </label>
            <label for="dot-8">
              <span class="dot eight"></span>
              <span class="gender">NCR</span>
            </label>
          </div>
          <div class="category">
            <label for="dot-4">
              <span class="dot four"></span>
              <span class="gender">CALABARZON</span>
            </label>
            <label for="dot-5">
              <span class="dot five"></span>
              <span class="gender">MIMAROPA</span>
            </label>
            <label for="dot-6">
              <span class="dot six"></span>
              <span class="gender">Bicol</span>
            </label>
            <label for="dot-7">
              <span class="dot seven"></span>
              <span class="gender">CAR</span>
            </label>
          </div>
          </div>
        
        <!-- province and city -->
          <div class="user-details">
            <!-- province -->
              <div class="input-box">
                <span class="details">Province <span style="color: cadetblue; font-size: 15px;">* that has Store Branches</span></span>
                <select name="province" id="province">
                  <option selected value="" disabled>Select Province</option>
                  <option value="" disabled>-- Ilocos</option>
                    <option value="Ilocos Norte">Ilocos Norte</option>
                    <option value="Ilocos Sur">Ilocos Sur</option>
                    <option value="La Union">La Union</option>
                    <option value="Pangasinan">Pangasinan</option>

                  <option value="" disabled>-- Cagayan Valley</option>
                    <option value="Cagayan">Cagayan</option>
                    <option value="Isabela">Isabela</option>

                  <option value="" disabled>-- Central Luzon</option>
                    <option value="Bataan">Bataan</option>
                    <option value="Bulacan">Bulacan</option>
                    <option value="Nueva Ecija">Nueva Ecija</option>
                    <option value="Pampanga">Pampanga</option>
                    <option value="Tarlac">Tarlac</option>
                    <option value="Zambales">Zambales</option>

                  <option value="" disabled>-- CALABARZON</option>
                    <option value="Batangas">Batangas</option>
                    <option value="Cavite">Cavite</option>
                    <option value="Laguna">Laguna</option>
                    <option value="Quezon">Quezon</option>
                    <option value="Rizal">Rizal</option>

                  <option value="" disabled>-- MIMAROPA</option>
                    <option value="Marinduque">Marinduque</option>
                    <option value="Oriental Mindoro">Oriental Mindoro</option>

                  <option value="" disabled>-- Bicol Region</option>
                    <option value="Albay">Albay</option>
                    <option value="Camarines Sur">Camarines Sur</option>

                  <option value="" disabled>-- CAR </option>
                    <option value="Benguet">Benguet</option>

                  <option value="" disabled>-- NCR </option>
                    <option value="Metro Manila">Metro Manila</option>
                </select>
              </div>
            <!-- city -->
              <div class="input-box">
                <span class="details">City <span style="color: cadetblue; font-size: 15px;">* that has Store Branches</span></span>
                <select name="city" id="city">
                  <option selected value="" disabled>Select City</option>
                  <option value="" disabled>-- Ilocos Norte</option>
                    <option value="Laoag City">Laoag City</option>
                    <option value="San Nicolas">San Nicolas</option>
            
                  <option value="" disabled>-- Ilocos Sur</option>
                    <option value="Vigan City">Vigan City</option>
                    <option value="San Nicolas">San Nicolas</option>
                    
                  <option value="" disabled>-- La Union</option>
                    <option value="San Fernando City">San Fernando City</option>
                    
                  <option value="" disabled>-- Pangasinan</option>
                    <option value="Bayambang">Bayambang</option>
                    <option value="Calasiao">Calasiao</option>
                    <option value="Dagupan City">Dagupan City</option>
                    <option value="Manaoag">Manaoag</option>
                    <option value="Rosales">Rosales</option>
                    <option value="San Carlos City">San Carlos City</option>
                    <option value="Mangatarem">Mangatarem</option>
                    <option value="Urdaneta City">Urdaneta City</option>
                    <option value="Villasis">Villasis</option>
            
                  <option value="" disabled>-- Cagayan</option>
                    <option value="Tuguegarao">Tuguegarao</option>
            
                  <option value="" disabled>-- Isabela</option>
                    <option value="Alicia">Alicia</option>
                    <option value="Cauayan">Cauayan</option>
                    <option value="Ilagan City">Ilagan City</option>
                    <option value="Santiago">Santiago</option>
                    <option value="Santo Tomas">Santo Tomas</option>
                    <option value="Tumauini">Tumauini</option>
            
                  <option value="" disabled>-- Bataan</option>
                    <option value="Balanga City">Balanga City</option>
                    <option value="Dinalupihan">Dinalupihan</option>
                    <option value="Limay">Limay</option>
                    <option value="Orani">Orani</option>

                  <option value="" disabled>-- Bulacan</option>
                    <option value="Balagtas">Balagtas</option>
                    <option value="Baliuag">Baliuag</option>
                    <option value="Bulakan">Bulakan</option>
                    <option value="Guiguinto">Guiguinto</option>
                    <option value="Hagonoy">Hagonoy</option>
                    <option value="Malolos City">Malolos City</option>
                    <option value="Marilao">Marilao</option>
                    <option value="Meycauayan City">Meycauayan City</option>
                    <option value="Pandi">Pandi</option>
                    <option value="Plaridel">Plaridel</option>
                    <option value="Pulilan">Pulilan</option>
                    <option value="San Jose del Monte City">San Jose del Monte City</option>
                    <option value="Santa Maria">Santa Maria</option>
            
                  <option value="" disabled>-- Nueva Ecija</option>              
                    <option value="Cabanatuan City">Cabanatuan City</option>
                    <option value="Gapan City">Gapan City</option>
                    <option value="Guimba">Guimba</option>
                    <option value="San Jose City">San Jose City</option>
                    <option value="Talavera">Talavera</option>
            
                  <option value="" disabled>-- Pampanga</option>              
                    <option value="Angeles City">Angeles City</option>
                    <option value="Apalit">Apalit</option>
                    <option value="Arayat">Arayat</option>
                    <option value="Candaba">Candaba</option>
                    <option value="Floridablanca">Floridablanca</option>
                    <option value="Guagua">Guagua</option>
                    <option value="Mabalacat City">Mabalacat City</option>
                    <option value="Magalang">Magalang</option>
                    <option value="Masantol">Masantol</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Porac">Porac</option>
                    <option value="San Fernando City">San Fernando City</option>
                    <option value="Santo Tomas">Santo Tomas</option>
            
                  <option value="" disabled>-- Tarlac</option>              
                    <option value="Capas">Capas</option>
                    <option value="Paniqui">Paniqui</option>
                    <option value="Tarlac City">Tarlac City</option>
                    
                  <option value="" disabled>-- Zambales</option>              
                    <option value="Iba">Iba</option>
                    <option value="Olongapo City">Olongapo City</option>
                    <option value="Subic">Subic</option>
            
                  <option value="" disabled>-- Batangas</option>              
                    <option value="Balayan">Balayan</option>
                    <option value="Batangas City">Batangas City</option>
                    <option value="Lemery">Lemery</option>
                    <option value="Lipa City">Lipa City</option>
                    <option value="Malvar">Malvar</option>
                    <option value="Nasugbu">Nasugbu</option>
                    <option value="Rosario">Rosario</option>
                    <option value="Santo Tomas">Santo Tomas</option>
                    <option value="Tanauan">Tanauan</option>
            
                  <option value="" disabled>-- Cavite</option>              
                    <option value="Bacoor City">Bacoor City</option>
                    <option value="Carmona">Carmona</option>
                    <option value="Cavite City">Cavite City</option>
                    <option value="Dasmariñas City">Dasmariñas City</option>
                    <option value="General Mariano Alvarez">General Mariano Alvarez</option>
                    <option value="General Trias City">General Trias City</option>
                    <option value="Imus City">Imus City</option>
                    <option value="Noveleta">Noveleta</option>
                    <option value="Silang">Silang</option>
                    <option value="Rosario">Rosario</option>
                    <option value="Tagaytay City">Tagaytay City</option>
                    <option value="Tanza">Tanza</option>
                    <option value="Trece Martires City">Trece Martires City</option>
            
                  <option value="" disabled>-- Laguna</option>              
                    <option value="Biñan City">Biñan City</option>
                    <option value="Cabuyao City">Cabuyao City</option>
                    <option value="Calamba City">Calamba City</option>
                    <option value="Los Baños">Los Baños</option>
                    <option value="Pagsanjan">Pagsanjan</option>
                    <option value="San Pablo City">San Pablo City</option>
                    <option value="San Pedro City">San Pedro City</option>
                    <option value="Santa Cruz">Santa Cruz</option>
                    <option value="Santa Rosa City">Santa Rosa City</option>
            
            
                  <option value="" disabled>-- Quezon</option>              
                    <option value="Candelaria">Candelaria</option>
                    <option value="Tiaong">Tiaong</option>
            
                  <option value="" disabled>-- Rizal</option>              
                    <option value="Angono">Angono</option>
                    <option value="Antipolo City">Antipolo City</option>
                    <option value="Binangonan">Binangonan</option>
                    <option value="Cainta">Cainta</option>
                    <option value="Rodriguez">Rodriguez</option>
                    <option value="San Mateo">San Mateo</option>
                    <option value="Tanay">Tanay</option>
                    <option value="Taytay">Taytay</option>
                  
                  <option value="" disabled>-- Marinduque</option>              
                    <option value="Boac">Boac</option>
                  
                  <option value="" disabled>-- Oriental Mindoro</option>              
                    <option value="Calapan City">Calapan City</option>
                  
            
                  <option value="" disabled>-- Albay</option>              
                    <option value="Legazpi City">Legazpi City</option>  
            
            
                  <option value="" disabled>-- Camarines Sur</option>              
                    <option value="Iriga City">Iriga City</option>  
                    <option value="Naga City">Naga City</option>   
            
                  <option value="" disabled>-- Benguet</option>              
                    <option value="Baguio City">Baguio City</option>
                    <option value="La Trinidad">La Trinidad</option>
            
                  <option value="" disabled>-- Metro Manila</option>              
                    <option value="Caloocan City">Caloocan City</option> 
                    <option value="Las Piñas City">Las Piñas City</option> 
                    <option value="Makati City">Makati City</option>
                    <option value="Malabon City">Malabon City</option> 
                    <option value="Mandaluyong City">Mandaluyong City</option> 
                    <option value="Manila City">Manila City</option> 
                    <option value="Markina City">Markina City</option> 
                    <option value="Muntinlupa City">Muntinlupa City</option> 
                    <option value="Navotas City">Navotas City</option> 
                    <option value="Parañaque City">Parañaque City</option> 
                    <option value="Pasay City">Pasay City</option> 
                    <option value="Pasig City">Pasig City</option> 
                    <option value="Quezon City">Quezon City</option> 
                    <option value="San Juan City">San Juan City</option> 
                    <option value="Taguig City">Taguig City</option> 
                    <option value="Valenzuela City">Valenzuela City</option>
                </select>
              </div>

        <!-- Store --> 
            <!-- store -->
            <div class="input-box">
              <span class="details">Store</span>
              <select name="selected_store" id="selected_store">
                <option selected value="" disabled>Select Store</option>
                  <option value="Store A">Store A</option>
                  <option value="Store B">Store B</option>
                  <option value="Store C">Store C</option>
              </select>
            </div>
          <!-- branch -->
            <div class="input-box">
              <span class="details">Branch</span>
              <select name="selected_branch" id="selected_branch">
                <option selected value="" disabled>Select Store Branch</option>
                <option value="" disabled>-- Store A</option>              
                  <option value="Branch A">Branch A</option> 
                  <option value="Branch B">Branch B</option> 
                  <option value="Branch C">Branch C</option>

                <option value="" disabled>-- Store B</option>              
                  <option value="Branch A">Branch A</option> 
                  <option value="Branch B">Branch B</option> 
                  <option value="Branch C">Branch C</option>

                <option value="" disabled>-- Store C</option>              
                  <option value="Branch A">Branch A</option> 
                  <option value="Branch B">Branch B</option> 
                  <option value="Branch C">Branch C</option>
              </select>
            </div>
          </div>


          <div class="gender-details">
            <input type="radio" name="time_of_pickup" value="10:00 AM" id="dot-9">
            <input type="radio" name="time_of_pickup" value="01:00 PM" id="dot-10">
            <input type="radio" name="time_of_pickup" value="05:00 PM" id="dot-11">
            <input type="radio" name="time_of_pickup" value="08:00 PM" id="dot-12">
            <span class="gender-title">Time of Pickup</span>
            <div class="category">
              <label for="dot-9">
                <span class="dot nine"></span>
                <span class="gender">10:00 AM</span>
              </label>
              <label for="dot-10">
                <span class="dot ten"></span>
                <span class="gender">01:00 PM</span>
              </label>
              <label for="dot-11">
                <span class="dot eleven"></span>
                <span class="gender">05:00 PM</span>
              </label>
              <label for="dot-12">
                <span class="dot twelve"></span>
                <span class="gender">08:00 PM</span>
              </label>
            </div>
          </div>

        <!-- message -->
          <div class="input-box">
            <span class="details">Message <span style="color: cadetblue; font-size: 15px;">*  This is optional</span></span>
            <textarea name="message" rows="4" cols="50" placeholder="Message for the beneficiary"></textarea>
          </div>

        <div class="button">
          <input type="submit" value="Submit Details">
          <a href="/shop_index" class="return" style="width: 20%; text-align: center; text-decoration: none; float: left; padding: 10px; margin: 10px; color: rgb(255, 188, 2); background: #333; border-radius: 5px;">Return</a>
        </div>
      </form>
    </div>
  </div>

  <!-- loader -->
    <div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
    </div>

  <!-- script for loading -->
    <script>
      $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
      });
    </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    @if (session('status'))
    swal({
      title: '{{ session('status') }}',
      icon: '{{ session('statuscode') }}',
    });
    @endif
  </script>
</body>
</html>
