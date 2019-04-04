<?php
    
    include("../utilities/Header.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Charts.php");
?>      
        

      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                <div class="col-md-12">
                  <h2 style="margin-top: 15px">User's Individual Employee's Performance Commitment and Review Report</h2>
                  <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 1px; "></div> 
                </div>
             </div>
            <!--END BREADCRUMBS-->
            <!--START DASHBOARD-->
            <section class="main-content">

                <div class="col-md-12" style="background-color: #262626; margin-bottom:10px; border: 2px solid #ffffff">
                  <div class="Panel" style="margin: 10px">
                   <form method="POST">
                        <label style="color: white; font-size: 18px">Action Available:</label>
                         <br>

                         <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-5">
                                    <label style="color: white">From:</label>
                                    <input type="month" class="form-control" name="start_date">
                                </div>
                                <div class="col-md-1" style="font-size: 20px">
                                  <i class="fa fa-calendar" style="margin-top: 25px; color: white"></i>
                                </div>
                                <div class="col-md-5">
                                    <label style="color: white">To:</label>
                                    <input type="month" class="form-control" name="end_date">
                                </div>

                               
                                
                            </div>
                         </div>

                         <div class="col-md-6" style="margin-top: 25px">
                            <button type="submit" class="btn btn-info" style="background-color: #002699" name="filter_date">
                                <i class="fa fa-refresh"></i>
                                Filter Report
                            </button>
                            &nbsp;
                            <button class="btn btn-success" type="button" onclick="printDiv('printable')" name="Print" style="background-color: green">
                                <i class="fa fa-print"></i>   
                                Print Report
                            </button>
                         </div>
                         <div class="row" style="margin-bottom: 10px"></div>
                    </form>
                  </div>
                </div>

                <div class="col-md-12" style="background-color: white">
                    <!--1st part-->
                    <?php include("rep_ipcr_filter.php"); ?>
                    <!--1st part-->
                </div>

            </section>


            <!--END DASHBOARD-->

          <?php include("rep_ipcr_printable.php");?>
          </section>
       </div>
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->
      <!--Printing-->
      <script src="../../../resources-web/custom/jasonday-printThis-edc43df/printThis.js"></script>


      <script type="text/javascript">
        // function print()
        // {
        //   $('#printable').printThis({
        //      debug: false,               // show the iframe for debugging
        //      importCSS: true,            // import page CSS
        //      importStyle:true,           // import style tags
        //      printContainer: true,       // grab outer container as well as the contents of the selector
        //      //loadCSS: "",              // path to additional css file - use an array [] for multiple
        //      pageTitle: "",              // add title to print page
        //      removeInline: false,        // remove all inline styles from print elements
        //      printDelay: 333,            // variable print delay
        //      header: null,               // prefix to html
        //      footer: "",                 // postfix to html
        //      base: false ,               // preserve the BASE tag, or accept a string for the URL
        //      formValues: true,           // preserve input/form values
        //      canvas: false,              // copy canvas elements (experimental)
        //      doctypeString: null,        // enter a different doctype for older markup
        //      removeScripts: false,       // remove script tags from print content
        //      copyTagClasses: false       // copy classes from the html & body tag
        //    });
        // }

        function printDiv(printable)
        {
            var printContents = document.getElementById(printable).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            
            window.print();
            
            document.body.innerHTML = originalContents;
        }
      </script>
   </body>
</html>




       
              
              

              
              
            