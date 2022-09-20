let schools = [];

for (var i = 50; i <= 100; i++) {
    link = 'http://www.educacao.sp.gov.br/central-de-atendimento/Consulta.asp?cod_mun=0&Ensino=0&Diretoria=0&Modalidade=0&rede=2&nome=&distrito=0&firsttime=Nao';
   
    if (i == 0) {
       link = link + '&Navegacao=Primeira&Paginar=1';
    } else {
       link = link + '&Navegacao=Proxima&Paginar='+i;
    }

    $.ajax({
        url: link,
        async: false, 
        success: function(response) {
            var data = $.parseHTML(response)[33];
            data = $(data).find('[name="form1"] table table tbody tr');
            

            $.each(data, function(i, v) {
                if (i > 0) {
                    var school = {
                        'link': $(v).find('td:eq(3) > a').attr('href'),
                        'nome': $(v).find('td:eq(3) > a').html(),
                        'municipio': $(v).find('td:eq(2) > a').html(),
                        'telefone': $(v).find('td:eq(6) > a').html()
                    }
                    schools.push(school);
                }
            });
        }
    });
}   

$.each(schools, function(index, school) {
    link = school.link;

    $.ajax({
        url: link,
        async: false, 
        success: function(response) {
            var data = $.parseHTML(response)[31];
            email = $(data).find('.localize-uma-escola tbody tr:eq(5) td:eq(1) > span').html();
            
            school.email = email;
        }
    });
});
console.log(schools);