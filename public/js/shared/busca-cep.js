$(document).ready(function(){
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#municipio").val("");
        $("#uf option:eq(0)").prop('selected',true);
    }
        //Quando o campo cep perde o foco.
    $("#cep").blur(function() {
        //Nova variável com valor do campo "cep".
        var cep = $(this).val();
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{5}-?[0-9]{3}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $('.loading').show();
                $("#logradouro").val("..."),
                $("#bairro").val("..."),
                $("#municipio").val("..."),
                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#municipio").val(dados.localidade);
                        $('#uf option[value="'+dados.uf+'"]').prop('selected', true);
                        $("#num").focus();
                        $('.loading').hide();
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alertMsg('CEP não encontrado','danger');
                        $('.loading').hide();
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alertMsg('Formato de CEP inválido','danger');
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});
