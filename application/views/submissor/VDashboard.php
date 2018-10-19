<!DOCTYPE html>

<div class="panel-body">

  <div class="container" style="background-color: #F5F5F5">

    <div class="panel-heading"">
      <h3>
        <center>
          <i class="fa fa-user"></i> <font size="6"> BEM-VINDO <?php echo $this->session->userdata('nome') ?></font>
        </center>
      </h3>
    </div>
  
    <hr>
    
    <center>
      <b><font size="6">Normas para Submissão de Trabalhos</font></b>
    </center>
    <br>

    <p>&nbsp;&nbsp;&nbsp;<font size="4">O 1º Congresso Regional de Ribeirão Preto da Associação Paulista de Saúde Pública receberá resumos de trabalhos no período de 06/07/2017 até o dia 27/08/2017, às 23:59 horas (horário de Brasília). Os resumos deverão ser enviados, exclusivamente pelo formulário eletrônico contido neste site e devem estar de acordo com os eixos temáticos que compõem esse congresso. 
    </font></p>

    <p>&nbsp;&nbsp;&nbsp;<font size="4">Após preencher o formulário de cadastro e realizar o pagamento, você deverá anexar o comprovante de pagamento referente ao pagamento na página de envio do resumo do(s) seu(s) trabalho(s), conforme orientação registrada na página de submissão. A seguir poderá enviar o seu trabalho e acompanhar todo o processo de avaliação, sempre informando o seu e-mail cadastrado e a sua senha. Esse congresso propõe que a avaliação seja feita em um processo de curadoria, ou seja, os trabalhos enviados poderão receber sugestões de melhorias ou de adequações que serão feitas pelos nossos curadores, até que cheguem à versão final. Essa proposta tem como objetivo estabelecer maior diálogo entre a comissão científica e os participantes, e permitir que os trabalhos possam ser aprimorados antes de sua apresentação no Congresso.
    </font></p>

    <p>&nbsp;&nbsp;&nbsp;<font size="4">Se você ainda não se inscreveu, <a href="<?php echo base_url('index.php/CHome/carrega_vcadastrar'); ?>">CLIQUE AQUI</a> para preencher o formulário de cadastro. Se você já se registrou, utilize seu login e senha para acessar sua área restrita e enviar o seu trabalho no menu “Submissão”.
    </font></p>

    <p>&nbsp;&nbsp;&nbsp;<u><b> <font size="5"> Escolha do eixo temático:</font> </b><font size="4"></u> Os interessados em submeter trabalhos devem selecionar inicialmente o eixo temático desejado e enviar um resumo. Os eixos temáticos estão distribuídos da seguinte maneira: 
    </font></p>

    <ol>
    <font size="3">
     <li> Saúde Mental e cultura: Como ser são num contexto insano. </li>
     <li> Participação Social em uma conjuntura antidemocrática: desafios e lutas.</li>
     <li> Gestão e redes de Atenção à Saúde: apostas possíveis em um SUS em (des) construção.</li>
     <li> Território e sustentabilidade: as lutas por moradia, alimentação, cultura, saúde, transporte e desenvolvimento sustentável.</li>
     <li> Educação: Cidadania X domesticação.</li>
     <li> Saúde e Gênero: desafios e conquistas.</li>
     </font>
    </ol>  

    <p>&nbsp;&nbsp;&nbsp;<u><font size="5"><b>Limites de resumos por participante:</font></b><font size="4"></u> Cada participante poderá submeter até três resumos como primeiro(a) autor(a). Não há limite para participação como coautor em trabalhos inscritos por outros participantes. No formulário informar: Título; Autores (informando primeiro o autor principal e em seguida, se houver, nome e filiação institucional de cada coautor). Atenção: conferir se as grafias estão corretas, pois serão assumidas em certificados. Não devem ser inseridos gráficos, tabelas ou outros recursos visuais no resumo, apenas o texto.
    </font></p>

    <p>&nbsp;&nbsp;&nbsp;<u><b><font size="5">Categorias de Apresentação do Trabalho:</font></b></u><font size="4"> Para submeter seu resumo à avaliação você precisará escolher um dos grupos temáticos da lista ofertada e uma das duas categorias de apresentação:
    </font></p>


    <ul type="disc">
    <font size="4">
     <li> <b>Relato de Pesquisa:</b> são trabalhos originais realizados por pesquisadores, trabalhadores, usuários e estudantes de graduação e de pós-graduação de instituições públicas e privadas. No formulário informar: Título; Autores (informando primeiro o autor principal e em seguida, se houver, nome e filiação institucional de cada coautor. Atenção: conferir se as grafias estão corretas, pois serão assumidas em certificados. Não devem ser inseridos gráficos, tabelas ou outros recursos visuais no resumo, apenas o texto. O resumo deve ser apresentado em um único parágrafo, contendo as seguintes sessões:
     </li>
     </font>
    </ul>
    <ol type="a">
    <font size="3">
     <li>Introdução.</li>
     <li>Objetivos.</li>
     <li>Materiais e métodos.</li>
     <li>Resultados e discussão.</li>
     <li>Considerações finais.</li>
    </font>
    </ol>

    <ul type="disc">
    <font size="4">
     <li> <b>Relato de Experiência:</b> Nesta categoria de trabalhos, serão aceitos relatos de experiências que foram desenvolvidas/concluídas ou estão em curso. O resumo deve estar organizado em torno das seguintes informações contendo:
     </font>
     </li>
    </ul>
    <ol type="a">
    <font size="4">
     <li> Introdução: destacar o contexto, o envolvimento dos autores e a motivação que levou a realização do trabalho; informe caso tenha alguma teoria que sustenta/sustentou o embasamento do trabalho.</li>
     <li> Objetivos: o que se esperava com essa iniciativa/intervenção.</li>
     <li> Processo de trabalho: como foi desenvolvido (a implantação ou a implementação) desse trabalho, o(s) local(is) envolvidos, os atores participantes (trabalhadores, usuários, estudantes, outros), os recursos materiais e financeiros que utilizou e como os obteve, se foi estabelecido algum parâmetro para acompanhar a implantação/implementação desse trabalho.</li>
     <li> Resultado: comente sobre os efeitos e implicações geradas com esse trabalho.</li>
     <li> Considerações finais: o que você considera que aprendeu com esse trabalho, quais foram os aspectos dificultadores e facilitadores nesse processo; contribuições que esse trabalho gera/gerou para a temática escolhida.</li>
    </font></ol>


    <!-- Rever essa estrutura. -->
    <p>&nbsp;&nbsp;&nbsp;<u><b><font size="5">Estrutura dos resumos:</font></b></u><font size="4"> Todos os resumos devem ser submetidos em Português e devem conter no máximo 4.000 caracteres com espaço, incluindo o título e a apresentação dos autores. Solicita-se o uso de fonte do tipo Times New Roman, em tamanho 10 pt. O título deve ser escrito em letras MAIÚSCULAS, negrito, justificado a esquerda. Os autores deverão estar justificado(s) à esquerda, com o nome completo em letra maiúscula, iniciando pelo nome do autor principal. O apresentador(a) deverá estar com o nome sublinhado. Os nomes deverão estar separados com ponto e vírgula (;), em cada nome deverá constar a numeração sobrescrita informando a Instituição pertencente. O nome da agência de fomento ou empresa que deram suporte à investigação deve ser mencionado no final do resumo.
    </font></p>

    <p>&nbsp;&nbsp;&nbsp;<u><b><font size="5">Modalidade de Apresentação:</font></b><font size="4"></u> Os trabalhos aprovados serão apresentados no formato de pôster impresso, com rodas de conversa por grupos temáticos, com debate mediado pela coordenação de cada sessão. Essas rodas de conversa farão parte das atividades de dispersão, previstas para ocorrer na sexta feira, de 8 às 18 horas, em espaços diversificados, como escolas de 1º e 2º graus, escolas técnicas, faculdades, unidades básicas e especializadas de saúde, assentamentos rurais, duas praças públicas, contando com expositores, debatedores e membros da comissão científica e curadores que estão se propondo a participar destas atividades. Além dessas rodas de conversa, a proposta é que os pôsteres sejam expostos também no sábado, durante as atividades de encerramento do congresso.   Cada trabalho terá dez minutos para apresentação. Após as apresentações, haverá uma roda de conversa com os respectivos autores mediado por um coordenador, a ser designado pela Comissão Científica.
    </font></p>

    <p>&nbsp;&nbsp;&nbsp;<u><b><font size="4">Impressão dos Pôsteres:</b></font></u><font size="4"> As dimensões do pôster deverão ser: 90 centímetros de largura por 1,20 metros de altura, em formato vertical.
    </font></p>

    <p>&nbsp;&nbsp;&nbsp;<u><b><font size="5">Envio de resumos:</font></b></u></p>

    <ul type="disc">
    <font size="4">
     <li>Para submeter trabalhos ao processo de avaliação, você deverá acessar o menu restrito "Submissões". Caso você não esteja visualizando este menu, é porque ainda não foi reconhecido pelo sistema. Neste caso, proceda conforme as seguintes instruções:</li>
     <li>Novo usuário: Se você ainda não fez sua inscrição no evento, acesse o menu "Cadastro" e preencha o formulário ao final da página. Lembre-se de ler atentamente as informações contidas nesta página antes de proceder com o cadastro. Ao finalizar o envio do formulário, acesse sua área restrita para que você encontre o menu "Meus Trabalhos", mencionado acima.</li>
     <li>Usuário já cadastrado: Se você já efetuou sua inscrição, basta acessar sua área restrita, informando o login e a senha correspondentes. O login e a senha foram preenchidos por você no momento da inscrição. Caso tenha se esquecido de seus dados de acesso, clique no botão "Relembrar senha".</li>
     <li>Antes do envio de seu resumo, faça uma revisão detalhada do texto que será submetido para avaliação.</li>
     <li>Caso você perceba algum erro após o envio, até o dia 27/08/2017 será permitida a edição do resumo. Para isso, basta acessar a sua área restrita, e, na seção “Meus Trabalhos”, clicar no título do trabalho.</li>
     <li>Os itens a serem preenchidos para submissão do resumo: Eixo - Selecionar de acordo com a listagem dos grupos temáticos. Apresentador do trabalho - indicar o nome, a filiação institucional e o correio eletrônico do autor principal ou coautor que apresentará o trabalho. Fonte(s) de financiamento - crédito a órgãos financiadores da pesquisa, se pertinente. Anexar o comprovante de pagamento. </li>
    </font>
    </ul>

    <p>&nbsp;&nbsp;&nbsp;<u><b><font size="5">Critérios para Avaliação dos Trabalhos:</font></b></u><font size="4"> Além da observância aos requisitos de resumos acima explicitados, o processo de avaliação adotará os seguintes critérios:
    </font></p>

    <ul type="disc">
    <font size="3">
     <li>Adequação à temática do congresso;</li>
     <li>Adequação ao escopo do eixo temático;</li>
     <li>Relevância social, atualidade e natureza inovadora;</li>
     <li>Adequação conceitual e metodológica para o alcance dos objetivos e dos resultados;</li>
     <li>Características do resumo submetido no que se refere à organização, capacidade de síntese e clareza de exposição; </li>
     <li>Adequação do título;</li>
     <li>A Comissão Científica se reserva ao direito de recusar resumos de trabalhos que não se adéquam aos valores da APSP. </li>
    </font>
    </ul> 

    <p>&nbsp;&nbsp;&nbsp;<u><b><font size="5">Processo de curadoria:</b></font></u></font></p>

    <ul type="disc">
    <font size="4">
     <li>Após a avaliação inicial, segundo os critérios descritos, o trabalho submetido poderá receber algumas sugestões de melhorias ou adequações feitas pelos nossos curadores. A proposta é que as experiências trazidas para o 1º Congresso Regional de Ribeirão Preto da Associação Paulista de Saúde Pública sejam abordadas da maneira mais completa possível. Nossa intenção é auxiliar, quando necessário, no aperfeiçoamento da escrita dos resumos, de maneira colaborativa e integrativa.</li>
     <li>Para isso, contamos com curadores que têm experiência nos eixos temáticos do congresso, e entrarão em contato diretamente com os autores dos resumos. Cabe aos autores, por sua vez, permanecerem atentos às sugestões dos curadores e darem retornos dentro dos prazos solicitados.</li>
     <li>Tanto a sugestão dos curadores quanto o retorno dos autores será feito dentro do site do congresso, na área restrita, que deve ser acessada com seu login e senha. </li>
     <li>Salientamos que o período de curadoria ocorrerá entre 27/08/2017 a 04/09/2017.</li>
     <li>Os autores que não derem retorno aos curadores durante esse processo podem correr o risco de não terem seus trabalhos aceitos para a apresentação. </li>
    </font>
    </ul>

    <p>&nbsp;&nbsp;&nbsp;<u><b><font size="5">Observações:</font></b></u></font></p>

    <ul type="disc">
    <font size="4">
     <li>É IMPRESCINDÍVEL o preenchimento adequado de todos os campos do formulário online, a anexação do comprovante de pagamento e, para serem aceitos, os trabalhos deverão obedecer às normas aqui descritas.</li>
     <li>O número de trabalhos aprovados será definido segundo a sua adequação ao tempo e aos limites dos espaços disponíveis nos espaços do Congresso.</li>
     <li>Os autores serão informados oportunamente sobre as datas, horários e locais das apresentações, por meio de e-mails e no ambiente restrito do congressista no site do Congresso.</li>
    </font>
    </ul>


    <p>&nbsp;&nbsp;&nbsp;<u><b><font size="5">Datas importantes:</font></b></u></font></p>

    <ul type="disc">
    <font size="4">
     <li>Data limite para envio de resumos: 27/08/2017;</li>
     <li>Período de Curadoria: de 27/08 a 04/09;</li>
     <li>Divulgação do resultado da avaliação: A partir de 07/09/2017;</li>
     <li>Prazo para pagamento da taxa de inscrição para autores responsáveis e apresentadores:  até 27/08/2017 (comprovante deve ser anexado juntamente com a submissão do resumo).</li>
    </font>
    </ul>

