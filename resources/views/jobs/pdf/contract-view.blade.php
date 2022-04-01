<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        span.nbsp {
            display: inline-block;
            width: 70px;
        }
        p {text-align: justify;}
        .page_break { page-break-before: always; }
        .signature {
            position: absolute;
            left: 0px;
            bottom: 0px;
            max-width: 150px;
        }
        .signature_right {
            position: absolute;
            right: 0px;
            bottom: 0px;
            max-width: 150px;
        }
    </style>
</head>
<body style="padding: 30px">
    <h1 style="text-align: center; font-size:20px">CONTRATO DE APRESENTAÇÃO ARTÍSTICA</h1>
    <p>
        <span class="nbsp"> </span>
        Pelo presente instrumento particular de contrato de apresentação
        artística, que fazem entre si, de um lado, como <b>CONTRATANTE</b>,
        {{ $name }}, com inscrição no CPF sob o nº {{ $cpf }}, residente
        e domiciliada na {{ $address }}, e, de outro lado, como <b>CONTRATADA</b>, Marcelo
        Fabro Fulcher, brasileiro, músico, inscrito no CPF n.o 988.705.720-72,
        residente e domiciliado na Rua Coronel Pena De Morais 533. Apto 301,
        Farroupilha-RS os quais formalizam o presente contrato, sob as seguintes
        cláusulas: 
    </p>
    <p>
        <b>CLÁUSULA PRIMEIRA</b> – Pelo presente instrumento, a <b>CONTRATADA</b>
        compromete-se a realizar apresentação artística na data de {{ $date }} às
        {{ $time }} no {{ $place }} em {{ $city }}. O serviço deverá ser executado em três momentos
        específicos: 
    </p>
    {!! $custom_text !!}
    <p>
        <b>CLÁUSULA SEGUNDA</b> – Constituem obrigações da <b>CONTRATANTE</b>:
        <ol type="a">
            <li>Fornecer energia elétrica no local da apresentação em condições de carga
                e segurança, compatíveis com todos os equipamentos necessários, assim
                como atender às necessidades técnicas para a satisfatória sonorização dos
                instrumentos citados na CLÁUSULA PRIMEIRA deste contrato
            </li>
            <li>É imprescindível que se atenda às necessidades descritas a seguir para a
                melhor execução do serviço: O piso deve ser regular e sem inclinação,
                fazendo com que os instrumentos e os músicos fiquem em uma posição
                correta e confortável. Observar para que o local onde os músicos serão
                posicionados não tenha incidência direta do sol.</li>
        </ol>
    </p>
    <p>
        <b>CLÁUSULA TERCEIRA</b> – Constituem obrigações da <b>CONTRATADA</b>:
        <ol type="a">
            <li>Comparecer e realizar a apresentação precisamente no dia, hora,
                local e condições estabelecidas neste contrato;</li>
        </ol>
    </p>
    <p>
        <b>CLÁUSULA QUARTA</b> – O preço ajustado é de R$ {{ $value }} ({{ $value_in_full }}) o
        qual deverá ser pago via PIX (CPF: 988.705.720-72) da seguinte forma:
        <p>
            <span class="nbsp"> </span>Pagamento de entrada de 20% na assinatura do contrato (R$ {{ $value_entrance }})
        </p>
        <p>
            <span class="nbsp"> </span>Pagamento do valor restante até o dia {{ $limit_date }} (R$ {{ $value_final }})
        </p>
        
    </p>
    <p>
        <b>CLÁUSULA QUINTA</b> – Havendo alteração quanto à data, horário e local, deverá
        a <b>CONTRATANTE</b> avisar a <b>CONTRATADA</b> com antecedência, devendo o evento
        ser marcado para uma data em que a <b>CONTRATADA</b> possua equipe disponível
        para execução do serviço.
    </p>
    <p>
        <span class="nbsp"> </span><i>Parágrafo Único:</i> na eventualidade da <b>CONTRATANTE</b> transferir a data
        do evento, será verificada a disponibilidade de nova data pela <b>CONTRATADA</b>.
        Caso a nova data seja incompatível com a agenda da <b>CONTRATADA</b>, a
        <b>CONTRATANTE</b> pagará 50% do valor do serviço.
    </p>
    <p>
        <b>CLÁUSULA SEXTA</b> - Na eventualidade da <b>CONTRATADA</b> se atrasar ou não
        comparecer ao evento por motivo de caso fortuito ou força maior que possam
        vir a interferir no itinerário até o local de execução do contrato, a
        <b>CONTRATADA</b> devolverá na íntegra os valores pagos pela <b>CONTRATANTE</b>.
    </p>
    <p>
        <b>CLAUSULA SÉTIMA</b> – As partes comprometem-se e obrigam-se por si e seus
        sucessores a qualquer título elegendo o foro da Comarca de Farroupilha/RS
        como único competente para dirimir quaisquer questões que dele decorram,
        com renúncia expressa a qualquer outro, mesmo que privilegiado.
        <br>
        E por estarem justos e contratados, assinam o presente instrumento em duas
        vias de igual teor e forma na presença de testemunhas, para que surta seus
        jurídicos e legais efeitos.
    </p>
    {{-- <div class="page_break"></div> --}}
    <img class="signature" src="{{$_SERVER["DOCUMENT_ROOT"]."/marcel-fabro/img/assinatura.png"}}"/>
    <img class="signature_right" src="{{$_SERVER["DOCUMENT_ROOT"]."/marcel-fabro/img/assinatura_contratante.png"}}"/>
</body>
</html>
