
<div class="modal fade" id="settingModal" tabindex="-1" aria-labelledby="newxmple" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content settings--modal">
          <h5 class="modal-title dancing--script" id="newxmple">
            <?php
              if(isset($_SESSION['username'])){
                echo $_SESSION['username'];
              }
            ?>
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
    </svg>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
            <!-- settings information... -->
             <a href="user/profile.php" class="profile--links">
                    Update Profile
                <i class="fa-solid fa-gear"></i>
             </a>

             <a href="user/order.php" class="profile--links">
                    My Order
                <i class="fa-solid fa-box"></i>
             </a>

             <a href="user/bookings.php" class="profile--links">
                    My Booking
                <i class="fa-solid fa-calendar"></i>
             </a>

             <a href="partials/ConfirmDelete.php" class="profile--links">
                    Delete Account
                <i class="fa-solid fa-trash"></i>
             </a>
             </div>
        </div>
      </div>
    </div>
    