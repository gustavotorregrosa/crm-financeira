$(".btn-am-reativar").on("click", function(){
    let id = $(this).data('id');
    let nome = $(this).data('nome');
    $("#empresa-id").val(id);
    $("#span-nome-empresa").html(nome);
    $("#mdl-reativa-empresa").modal("show");


});


$("#btn-reativa-empresa").on("click", function(e){
    e.preventDefault();
    let id =  $("#empresa-id").val();
    let nome = $("#span-nome-empresa").html();

    $.ajax({
        type: "POST",
        url: '/reativa-empresa-deletada',
        data: {
            id: id
        },
        async: false,
        success: function(data){
            let msg = "Empresa " + nome + "reativada";
            $.notify(msg, "success");
            $('#mdl-reativa-empresa').modal("hide");
            setTimeout(function(){
                window.location.href = "/administrador/empresas";
            },500);
           
        },
        error: function(data){
            let msg = "Não foi possível reativar a empresa " + nome;
            $.notify(msg, "error");
            $('#mdl-reativa-empresa').modal("hide");
            setTimeout(function(){
                window.location.href = "/administrador/empresas";
            },500);
          
        }
     
      });


});