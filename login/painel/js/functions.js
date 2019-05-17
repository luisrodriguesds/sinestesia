$(function(){
    //informacoes
    var url         = $("#url").text();
    var infos       = $("#infos").text();
        infos       = infos.split(':');
    var id_user     = infos[0];
    var token       = infos[1];
    var id_trial    = $("#id_trial").text();
    var cor_rgb;
    var cor_hex;
    var checkPost   = true;
    //ATIVAR COLOR 
     $('#cp2').colorpicker({
      inline: true,
      container: true,
      customClass: 'colorpicker-2x',
      sliders: {
        saturation: {
          maxLeft: 300,
          maxTop: 300
        },
        hue: {
          maxTop: 300
        },
        alpha: {
          maxTop: 300
        }
      },
      useAlpha: false,
    });

    //Qunado houver o click arraste do circulo
    $("#cp2").on('colorpickerChange', function(e) {
        $(".box-color").css('background-color', e.color.toString());
        cor_rgb = getRGB(e.color.toString());
        cor_hex = rgbToHex(cor_rgb[0], cor_rgb[1], cor_rgb[2]);
        $(".box-color p").text(cor_hex+':rgb('+cor_rgb[0]+', '+cor_rgb[1]+', '+cor_rgb[2]+')');
        $('.colorpicker-bar').html('');
        $('.colorpicker-bar').css('background', e.color.toString());
        //converter RGB para hex
        //Colocar junto os dois codigos de cores juntos

        // console.log(e.color);
    });


    //Quando clicar no para escolher o trial
    $("body").on('click', '.btn-chose', function(event) {
        event.preventDefault();
        // $(this).attr('disebled');
        var chose = $(this).attr('rel');
        if (chose == 0) {
            var valor = $(".box-color p").text();
        }else{
            var valor = chose;
        }
        var id_trial = $("#id_trial").text();
        var dados = {token:token, id_user:id_user, valor:valor, id_trial:id_trial};
        if (checkPost == true) {
            checkPost = false;
            console.log(checkPost);
            $.post(url+'ajax/be-exames.php', dados, function(data, textStatus, xhr) {
                if (data != 'finish') {
                    data = $.parseJSON(data);
                    //Atualiza trial
                    var count = parseInt($('.trial-now').text())+1;
                    $('.trial-now').text(count);
                    //Printa novo trils
                    $(".box-trials h2").text(data.valor);
                    //Printa novo id_trials
                    $("#id_trial").text(data.id);
                    //Torna cor aleatoria
                    $('#cp2').colorpicker('setValue', getRandomColorRGB());

                    checkPost = true;
                    console.log(checkPost);
                }else{
                    //DEVE SER ENVIADO PARA STAR-CONFIRM
                    console.log("Ir pra o proximo teste");
                    window.location=url+'teste/start-confirme';
                }
            });
        }

        //Para cada trails ele mudar 
        // $('#cp2').colorpicker('setValue', 'rgba(255,255,255)');
    });

    //RETIRAR RGB DA TELA
    jQuery(window).load(function () {
        $('.colorpicker-bar div').text('');
    });

    //Hexadecimal
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    //RGB
    function getRandomColorRGB(){
        var hue = 'rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')';
        return hue;
    }

    //CONVERTER RGB EM HEX
    function rgbToHex(red, green, blue) {
        var rgb = blue | (green << 8) | (red << 16);
        return '#' + (0x1000000 + rgb).toString(16).slice(1)
    }

    //Hex em RGB
    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }
    //Retorna os numeros rgb
    function getRGB(rgb){
        rgb = rgb.replace("rgb(", "");
        rgb = rgb.replace(")", "");
        var arr = rgb.split(", ");
        return arr;
    }
});