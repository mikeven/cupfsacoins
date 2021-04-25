<?php
    /*
     * Cupfsa Coins - Reestablecer contraseña
     * 
     */
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-usuarios.php" );
    if( !isset( $_GET["token"] ) ){
        $usuario = NULL;
    }
?>
<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="author" content="okler.net">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="assets/vendor/modernizr/modernizr.js"></script>
        <style type="text/css">
            .alert{ display: none; margin-top: 20px; }
            .password_instrucciones{ font-size: 12px; color: #000; padding: 20px 0; }
        </style>
    </head>
    <body>
        <!-- start: page -->
        <section class="body-sign">
            <div class="center-sign">
                <a href="/" class="logo pull-left">
                    <img src="assets/images/logo_cupsfa.png" height="60" alt="CUPFSA"/>
                </a>

                <div class="panel panel-sign">
                    <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Reestablecer Contraseña</h2>
                    </div>
                    <div class="panel-body">
                        <?php if ( $usuario ){ ?>
                            <div class="alert alert-info">
                                <p class="text-semibold h6">Ingrese su nueva contraseña</p>
                            </div>

                            <form id="frm_reset_password">

                                <div class="password_instrucciones" align="center">
                                    La nueva contraseña debe contener: 
                                    <ul style="list-style: none;">
                                        <li>Mínimo 8 caracteres</li>
                                        <li>Una letra mayúscula</li>
                                        <li>Una letra minúscula</li>
                                        <li>Un caracter numérico</li>
                                        <li>Un caracter especial: (@#$%&*)</li>
                                    </ul>
                                </div>
                                <hr>
                                <div class="form-group mb-lg">
                                    <input type="hidden" id="tokenuser" name="token_reset_pass" value="<?php echo $_GET['token']?>">
                                    <input type="hidden" id="iduser" name="idusuario" value="<?php echo $usuario['idUSUARIO']?>">
                                    <label class="col-sm-3 control-label">Contraseña</label>
                                    <div class="col-sm-9">
                                        <input id="password1" type="password" name="password" class="form-control" 
                                            placeholder="Password" required/>
                                    </div>
                                </div>
                                <div class="form-group mb-lg">
                                    <label class="col-sm-3 control-label">Confirme contraseña</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password_conf" class="form-control" 
                                            placeholder="Password" required/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <button type="submit" class="btn btn-primary hidden-xs">Enviar</button>
                                    </div>
                                </div>
                                
                                <!-- ALERTS -->
                                <?php include( "sections/notificaciones/alert.html" ); ?>
                                
                            </form>
                        <?php } else { ?>
                            <div class="row">
                                <p class="frm_error">
                                    Este enlace no es válido. Intente reestablecer su contraseña nuevamente  
                                    <a href="https://coins.cupfsa.com/recuperar-password.php">Aquí</a>
                                </p>
                            </div> 
                        <?php } ?>    
                    </div>
                </div>

                <p class="text-center text-muted mt-md mb-md">Cupfsa Coins 2021</p>
            </div>
        </section>
        <!-- end: page -->

        <!-- Vendor -->
        <script src="assets/vendor/jquery/jquery.js"></script>
        <script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
        
        <!-- Theme Base, Components and Settings -->
        <script src="assets/javascripts/theme.js"></script>
        
        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>
        
        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>
        <script src="assets/vendor/jquery-validation/jquery.validate.js"></script>

        <script src="js/fn-ui.js"></script>
        <script src="js/fn-acceso.js"></script>
    </body>
</html>