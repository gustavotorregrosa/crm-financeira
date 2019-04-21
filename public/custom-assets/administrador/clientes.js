$(document).ready(function () {
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.dinheiro').mask("#.##0,00", {reverse: true});
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
        salario: $("#frm-add-cliente #salario-cliente").val().split('.').join('').replace(',','.')
        

        


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
