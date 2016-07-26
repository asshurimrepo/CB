   
<!--footer start-->
<footer class="site-footer">
    <div class="text-center">
        2016 &copy; Casterbuddy. All Rights Reserved.
        <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>
<!--footer end--> 
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <script src="js/jquery.customSelect.min.js" ></script>
    <script src="js/respond.min.js" ></script>

    <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <!--custom switch-->
    <script src="js/bootstrap-switch.js"></script>

    <!--right slidebar-->
    <script src="js/slidebars.min.js"></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/fuelux/js/spinner.js"></script>
    <!-- tweaks added by rigz -->

    <script type="text/javascript">
        $(document).ready(function(){
            $('.colorpicker-rgba').colorpicker();
            $('.modal').on('show.bs.modal', function () {
                if ($(document).height() > $(window).height()) {
                    // no-scroll
                    $('body').addClass("modal-open-noscroll");
                }
                else {
                    $('body').removeClass("modal-open-noscroll");
                }
                if($('#propertyDisplayAutomatically').is(':checked')){
                    $('.aftersec').show();
                }
            })
            $('.modal').on('hide.bs.modal', function () {
                $('body').removeClass("modal-open-noscroll");
            })
            $("#propertyDisplayAutomatically").change(function() {
                if(this.checked) {
                    $('.aftersec').show();
                }else{
                    $('.aftersec').hide();
                }
            });

            // Switch
            $("[data-toggle='switch']").wrap('<div class="switch" />').parent().bootstrapSwitch();
            //Spinner
            $('#fontsize').spinner({
                min: 10,
                max: 40
            });               
            $('.spinner').spinner({
                min: -9999
            });                 
        });
    </script>
