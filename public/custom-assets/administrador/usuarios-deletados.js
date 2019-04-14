$(".btn-am-reativar").on("click", function(){
    let id = $(this).data('id');
    let nome = $(this).data('nome');
    $("#user-id").val(id);
    $("#span-nome-user").html(nome);
    $("#mdl-reativa-user").modal("show");


});


$("#btn-reativa-user").on("click", function(e){
    e.preventDefault();
    let id =  $("#user-id").val();
    let nome = $("#span-nome-user").html();

    $.ajax({
        type: "POST",
        url: '/reativa-usuario-deletado',
        data: {
            id: id
        },
        async: false,
        success: function(data){
            let msg = "Usuario " + nome + "reativado";
            $.notify(msg, "success");
            $('#mdl-reativa-user').modal("hide");
            setTimeout(function(){
                window.location.href = "/administrador/usuarios";
            },500);
           
        },
        error: function(data){
            let msg = "Não foi possível reativar o usuário " + nome;
            $.notify(msg, "error");
            $('#mdl-reativa-user').modal("hide");
            setTimeout(function(){
                window.location.href = "/administrador/usuarios";
            },500);
          
        }
     
      });


});