$(function() {

    //---------------------les fonction auxilliaires booleene de de regex pour les champs de nom,email et mot de pass--------------

    function phone_verif(phone) {
        var regex1 = /^(+[0-9]{1,5}){0,1}[0-9]{6,}$/;
        if (regex.test(phone)) {
            return true;
        } else {
            return false;
        }
    }

    function password_verif(password) {
        var regex = /^[a-zA-Z0-9]{6,}$/;
        if (regex.test(password)) {
            return true;
        } else {
            return false;
        }
    }

    function name_verif(name) {
        var regex = /^[a-zA-Z]{1,}[a-zA-Z._ -éêâäîôûçàµ£$]*$/i;
        if (regex.test(name)) {
            return true;
        } else {
            return false;
        }
    }

    function code_verif(name) {
        var regex = /^[a-zA-Z0-9]{8,}$/i;
        if (regex.test(name)) {
            return true;
        } else {
            return false;
        }
    }

    //____________________________________________________________________________________________________________________________
    //---------------------les fonction general de mise en forme css pour les champs de nom,email et mot de pass--------------

    function verif_info_mail(mail_champ) {

        mail_champ.focus(function() {
            $(this).keyup(function() {
                if (mail_verif($(this).val())) {
                    $(this).css('color', 'green').css('border', '2px solid green');
                } else {
                    $(this).css('color', 'red').css('border', '2px solid red');
                }
            });
        });
    }

    function verif_info_password(password_champ) {

        password_champ.focus(function() {
            $(this).keyup(function() {
                if (password_verif($(this).val()) && $(this).val().length >= 6) {
                    $(this).css('color', 'green').css('border', '2px solid green');
                } else {
                    $(this).css('color', 'red').css('border', '2px solid red');
                }
            });
        });
    }

    var mail = $('.mail_connect'),
        password = $('.password_connect');

})