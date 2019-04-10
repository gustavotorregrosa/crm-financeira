$(document).ready(function () {
   listar();
   
   


});


var listar = function(){
    var tabela = $("#dt_usuarios").DataTable({
        // "responsive": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "/administrador/usuariosjson"
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {"data": "perfil_usuario.nome"},
            // {"data": "supervisor.name"}
            {"data": function(usuario){
              if(usuario.supervisor){
                return usuario.supervisor.name;
              }
              else{
                  return "";
              }
            }},
            {"defaultContent": "<button type='button' class='btn-editar btn btn-primary btn-sm'>Editar</button>&nbsp;&nbsp;<button type='button' class='btn-deletar btn btn-danger btn-sm'>Deletar</button>"}
            
        ]

    });
    var tbody = $("tbody");
    pega_dados_edicao(tbody, tabela);
    pega_dados_delecao(tbody, tabela);


}


var pega_dados_delecao = function(tbody, tabela){
    $(tbody).on("click", "button.btn-deletar", function(){
        var dados = tabela.row($(this).parents("tr")).data();
        $("#spn-usr-del").html(dados.name);
        $('#mdl-deleta-usuario').data("id-del", dados.id);
        $('#mdl-deleta-usuario').modal("show");
        
    });
}




var pega_dados_edicao = function(tbody, tabela){
    $(tbody).on("click", "button.btn-editar", function(){
        var dados = tabela.row($(this).parents("tr")).data();
        
    });
}

$("#btn-del-usr").on("click", function(){
    let id = $('#mdl-deleta-usuario').data("id-del");
    

    $('#mdl-deleta-usuario').modal("hide");

    
});