var estadosPossiveis;
var cidadesPorEstado;

$(document).ready(function () {
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.dinheiro').mask("#.##0,00", {reverse: true});
    $.ajax({
        type: "POST",
        url: '/pega-cidades',
        data: {},
        async: false,
        success: function(data){
            data = JSON.parse(data);
            estadosPossiveis = data.estados;
            // console.log(estadosPossiveis);
            cidadesPorEstado = data.cidades;
            // console.log(cidadesPorEstado);
           
        },
     
      });

      $("#uf-cliente option").remove();
      let padrao = new Option('Escolha um Estado', '');
      $(padrao).prop('defaultSelected', true);
      $(padrao).prop('disabled', true);
      $("#uf-cliente").append($(padrao));

      $.each(estadosPossiveis, function(index, estado){
          $("#uf-cliente").append($(new Option(estado, estado)));
      });


});


$("#uf-cliente").on("change", function(){
    estadoEscolhido = $("#uf-cliente").val();
    let cidadePossiveis = [];
    $("#cidade-cliente option").remove();
    let cidPadrao = new Option('Escolha uma cidade', '');
    $(cidPadrao).prop('defaultSelected', true);
    $(cidPadrao).prop('disabled', true);
    $("#cidade-cliente").append($(cidPadrao));

    $.each(cidadesPorEstado, function(index, municipio){
        if(estadoEscolhido == municipio.estado){
            $("#cidade-cliente").append($(new Option(municipio.cidade, municipio.cidade)));
        }

       
    });

});

$("#btn-am-add-cliente").on("click", function(){
    $("#mdl-add-cliente").modal("show");
});



$("#btn-add-cliente").on("click", function(e){
    e.preventDefault(); 
    let dadosCliente = {
        nome: $("#frm-add-cliente #nome-cliente").val(),
        cpf: $("#frm-add-cliente #cpf-cliente").val(),
        empresa: $("#frm-add-cliente #empresa-cliente").val(),
        orgao: $("#frm-add-cliente #orgao-cliente").val(),
        beneficio: $("#frm-add-cliente #beneficio-cliente").val(),
        salario: $("#frm-add-cliente #salario-cliente").val().split('.').join('').replace(',','.'),
        uf: $("#frm-add-cliente #uf-cliente").val(),
        cidade: $("#frm-add-cliente #cidade-cliente").val(),
        

        


        // supervisor: $("#frm-criar-usuario #user-supervisor").val(),
        // senha: $("#frm-criar-usuario #user-senha").val(),
        // ativo: function(){
        //     if( $("#frm-criar-usuario #user-ativo")[0].checked){
        //         return 1;
        //     }
        //     return 0;
        // } 
        
    } 


    $.ajax({
        type: "POST",
        url: '/cria-cliente',
        data: dadosCliente,
        async: false,
        success: function(data){
            $.notify("Cliente criado", "success");
            $('#mdl-add-cliente').modal("hide");
            $("#frm-add-cliente")[0].reset();
            // init();
        },
        error: function(data){
            $.notify("Não foi possível criar o cliente", "error");
            $('#mdl-add-cliente').modal("hide");
            $("#frm-add-cliente")[0].reset();
            // init();
        }
     
      });




});
