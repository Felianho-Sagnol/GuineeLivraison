<footer>
        <div class="page-container container">
            <div class="footerbefore">
                <script>
                    /*function subscribe() {
                        var emailpattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                        var email = $('#txtemail').val();
                        if (email != "") {
                            if (!emailpattern.test(email)) {
                                $('.text-danger').remove();
                                var str = '<span class="error">Invalid Email</span>';
                                $('#txtemail').after('<div class="text-danger">Invalid Email</div>');

                                return false;
                            } else {
                                $.ajax({
                                    url: 'index.php?route=extension/module/newsletters/news',
                                    type: 'post',
                                    data: 'email=' + $('#txtemail').val(),
                                    dataType: 'json',


                                    success: function(json) {

                                        $('.text-danger').remove();
                                        $('#txtemail').after('<div class="text-danger">' + json.message + '</div>');

                                    }

                                });
                                return false;
                            }
                        } else {
                            $('.text-danger').remove();
                            $('#txtemail').after('<div class="text-danger">Email Is Require</div>');
                            $(email).focus();

                            return false;
                        }
                    }*/
                </script>
            </div>
        </div>
        <div class="page-container container">
            <div id="footer">
                <div class="row">
                    <div class="footer-blocks">
                        <div class="footerleft-block">

                            <div class="col-sm-3 column footerleft">
                                <div class="contact-block">
                                    <h5>Nous contacter </h5>
                                    <ul>
                                        <li>
                                            <span class="fig">Téléphone:</span>
                                            <i class="fa fa-call-marker"></i>
                                            <span>+01 2222 365 / +91 1256 789</span>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                            <span class="fig">Adresss:</span>
                                            <i class="fa fa-map-marker"></i>
                                            <span>507-UTC,Ring Road,California.</span>
                                        </li>
                                        <li>
                                            <span class="fig">Mail:</span>
                                            <i class="fa fa-envelope-o"></i>
                                            <span>sales@yourcompany.com</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-3 column">
                                <h5>Informations</h5>
                                <ul class="list-unstyled">
                                    <li><a href="#">A pros</a></li>
                                    <li><a href="#">Terms &amp; Conditions</a></li>
                                </ul>
                            </div>

                            <div id="extra-link" class="col-sm-3 column">
                                <div class="social-block">
                                    <h5>Nous suivre sur</h5>
                                    <ul>
                                        <li class="facebook"><a href="#"><span>Facebook</span></a></li>
                                        <li class="twitter"><a href="#"><span>Twitter</span></a></li>
                                        <li class="youtube"><a href="#"><span>YouTube</span></a></li>
                                        <li class="googleplus"><a href="#"><span>Google +</span></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-3 column">
                                <h5>Mon Compte</h5>
                                <ul class="list-unstyled">
                                    <li><a href="../../views/deconnexion.php">Deconnexion <span class="connectedfooter">(connecté)</a></li>
                                </ul>
                            </div>
                            <div class="footerright">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <div id="bottom-footer" class="bottomfooter">
            <div class="row">
                
            </div>
            <div class="page-container container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <p  class="text-center copyright"> © 2000-2021, Tous les droits sont reservés à Guinée Livraison</p>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" 
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" 
        crossorigin="anonymous"></script>
        <script src="../../js/functions.js"></script>
        <script src="../../js/admin/admin.js"></script>
        
	</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {

        $('#ourcategory-carousel').owlCarousel({
            items: 3,
            singleItem: false,
            navigation: false,
            pagination: true,
            autoPlay: false,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [991, 2],
            itemsTablet: [575, 1],
            itemsMobile: [480, 1]
        });

        $('#testimonial-carousel').owlCarousel({
            singleItem: true,
            navigation: false,
            pagination: false,
            autoPlay: false
        });
        // Custom Navigation Events
        $(".cztestimonial_next").click(function() {
            $('#testimonial-carousel').trigger('owl.next');
        })
        $(".cztestimonial_prev").click(function() {
            $('#testimonial-carousel').trigger('owl.prev');
        });

        $('.special-carousel').owlCarousel({
            items: 2,
            singleItem: false,
            navigation: false,
            pagination: false,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [991, 1],
            itemsTablet: [767, 1]
        });
        // Custom Navigation Events
        $(".special-next").click(function() {
            $('.special-carousel').trigger('owl.next');
        })
        $(".special-prev").click(function() {
            $('.special-carousel').trigger('owl.prev');
        });

        $('#service-carousel').owlCarousel({
            items: 3,
            singleItem: false,
            navigation: false,
            pagination: true,
            autoPlay: true,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [991, 2],
            itemsTablet: [650, 1],
            itemsMobile: [480, 1]
        });

        $('.brand-carousel').owlCarousel({
            items: 5,
            singleItem: false,
            navigation: true,
            pagination: false,
            autoPlay: true,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [991, 3],
            itemsTablet: [480, 2],
            itemsMobile: [380, 1]
        });
    });
</script>
<script type="text/javascript">
                // Sort the custom fields
                $('#account .form-group[data-sort]').detach().each(function() {
                    if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#account .form-group').length) {
                        $('#account .form-group').eq($(this).attr('data-sort')).before(this);
                    }

                    if ($(this).attr('data-sort') > $('#account .form-group').length) {
                        $('#account .form-group:last').after(this);
                    }

                    if ($(this).attr('data-sort') == $('#account .form-group').length) {
                        $('#account .form-group:last').after(this);
                    }

                    if ($(this).attr('data-sort') < -$('#account .form-group').length) {
                        $('#account .form-group:first').before(this);
                    }
                });

                /*$('input[name=\'customer_group_id\']').on('change', function() {
                    $.ajax({
                        url: 'index.php?route=account/register/customfield&customer_group_id=' + this.value,
                        dataType: 'json',
                        success: function(json) {
                            $('.custom-field').hide();
                            $('.custom-field').removeClass('required');

                            for (i = 0; i < json.length; i++) {
                                custom_field = json[i];

                                $('#custom-field' + custom_field['custom_field_id']).show();

                                if (custom_field['required']) {
                                    $('#custom-field' + custom_field['custom_field_id']).addClass('required');
                                }
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                });*/

                $('input[name=\'customer_group_id\']:checked').trigger('change');
                //-->
</script>
<script type="text/javascript">
                $('button[id^=\'button-custom-field\']').on('click', function() {
                    var element = this;

                    $('#form-upload').remove();

                    $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

                    $('#form-upload input[name=\'file\']').trigger('click');

                    if (typeof timer != 'undefined') {
                        clearInterval(timer);
                    }

                    timer = setInterval(function() {
                        if ($('#form-upload input[name=\'file\']').val() != '') {
                            clearInterval(timer);

                            $.ajax({
                                url: 'index.php?route=tool/upload',
                                type: 'post',
                                dataType: 'json',
                                data: new FormData($('#form-upload')[0]),
                                cache: false,
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    $(element).button('loading');
                                },
                                complete: function() {
                                    $(element).button('reset');
                                },
                                success: function(json) {
                                    $(element).parent().find('.text-danger').remove();

                                    if (json['error']) {
                                        $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                                    }

                                    if (json['success']) {
                                        //alert(json['success']);

                                        $(element).parent().find('input').val(json['code']);
                                    }
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                }
                            });
                        }
                    }, 500);
                });
                //-->
</script>
<script type="text/javascript">
                $('.date').datetimepicker({
                    language: '',
                    pickTime: false
                });

                $('.time').datetimepicker({
                    language: '',
                    pickDate: false
                });

                $('.datetime').datetimepicker({
                    language: '',
                    pickDate: true,
                    pickTime: true
                });
                //-->
</script>
<script>
                function quickbox() {
                    if ($(window).width() > 767) {
                        $('.quickview-button').magnificPopup({
                            type: 'iframe',
                            delegate: 'a',
                            preloader: true,
                            tLoading: 'Loading image #%curr%...',
                        });
                    }
                }
                jQuery(document).ready(function() {
                    quickbox();
                });
                jQuery(window).resize(function() {
                    quickbox();
                });


                $(document).ready(function() {
                    $('#service-carousel').owlCarousel({
                        items: 3,
                        singleItem: false,
                        navigation: false,
                        pagination: false,
                        autoPlay: true,
                        itemsDesktop: [1199, 3],
                        itemsDesktopSmall: [991, 2],
                        itemsTablet: [650, 1],
                        itemsMobile: [480, 1]
                    });
                });
</script>