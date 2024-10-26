
        <?php 

        function toastMessage($msg){
            echo '
               <div class="position-absolute start-50 translate-middle-x w-50 toast--container">
                <div class="toast--message">
                    <div class="btn btn-close close--btn"></div>
                <p class="fs-5">'. $msg .'</p>
                </div>
            </div> 
            ';
        }
        ?>