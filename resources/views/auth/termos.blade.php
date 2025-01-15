@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">Termos de Utilização</h3>

                <!-- Início dos Termos de Uso (container com scroll) -->
                <div 
                    id="termsContainer" 
                    class="mb-4" 
                    style="max-height: 400px; overflow-y: auto; border: 1px solid #ccc; padding: 15px;"
                >
                    <p><strong>TERMOS DE USO - REDE SOCIAL Bem-te-vi</strong></p>
                    <p>
                        Bem-vindo(a) à rede social <strong>Bem-te-vi</strong>.  
                        A seguir, apresentamos os Termos de Uso (“Termos”) que regem o acesso e a utilização de nossos serviços.  
                        Ao utilizar a Plataforma, você (“Usuário”) declara ter lido e concordado com todas as disposições aqui descritas.
                    </p>

                    <p><strong>1. OBJETIVO E PROPÓSITO DA PLATAFORMA</strong></p>
                    <p>
                        1.1. A Plataforma tem como objetivo oferecer um ambiente <strong>positivo e amigável</strong> para que os Usuários publiquem postagens e interajam com conteúdo gerado por outros.<br>
                        1.2. A fim de promover um convívio harmonioso, a Plataforma conta com o monitoramento de uma rede neural chamada <strong>BERTimbau</strong>, treinada para identificar e barrar postagens que promovam discurso de ódio ou linguagem ofensiva.
                    </p>

                    <p><strong>2. CADASTRO E USO DA PLATAFORMA</strong></p>
                    <p>
                        2.1. Para acessar e utilizar a Plataforma, o Usuário deverá criar uma conta e fornecer informações cadastrais verdadeiras e atualizadas.<br>
                        2.2. O Usuário é responsável por todas as ações realizadas em sua conta e pelo uso seguro de suas credenciais de acesso (login e senha).<br>
                        2.3. O Usuário compromete-se a não repassar suas credenciais de acesso a terceiros e a notificar imediatamente a administração da Plataforma em caso de uso não autorizado de sua conta ou qualquer suspeita de violação de segurança.
                    </p>

                    <p><strong>3. CONTEÚDO E REGRAS DE POSTAGEM</strong></p>
                    <p>
                        3.1. O Usuário poderá criar postagens em texto, respeitando as regras de convivência e as leis vigentes.<br>
                        3.2. As postagens poderão ser visualizadas e comentadas por outros Usuários, observadas as restrições estabelecidas nestes Termos.<br>
                        3.3. <strong>É proibido publicar ou disseminar conteúdo que seja considerado ofensivo ou que constitua discurso de ódio.</strong><br>
                        3.4. Entre os alvos de discurso de ódio monitorados pela BERTimbau incluem-se (mas não se limitam a):<br>
                        - Xenofobia<br>
                        - Racismo<br>
                        - Homofobia<br>
                        - Sexismo<br>
                        - Intolerância religiosa<br>
                        - Partidarismo<br>
                        - Desculpas pela ditadura<br>
                        - Antissemitismo<br>
                        - Fatfobia<br><br>
                        3.5. A Plataforma, por meio da análise da rede neural BERTimbau, poderá negar a publicação ou remover qualquer postagem que viole as regras acima.<br>
                        3.6. Caso o Usuário insista em publicar conteúdo que viole estes Termos, poderá sofrer suspensão ou cancelamento de sua conta, a critério exclusivo da administração.
                    </p>

                    <p><strong>4. ANÁLISE E MODERAÇÃO DE CONTEÚDO</strong></p>
                    <p>
                        4.1. Todas as postagens são analisadas pela BERTimbau, treinada com base em um dataset que busca identificar termos e contextos associados a discurso de ódio ou linguagem ofensiva.<br>
                        4.2. Em caso de detecção de conteúdo potencialmente ofensivo, a postagem será barrada para revisão manual pela equipe de moderação ou removida de forma imediata, conforme o grau de gravidade.<br>
                        4.3. A decisão de moderação pode ser reconsiderada a critério da administração, mediante justificativa do Usuário e avaliação de possíveis erros de classificação pela rede neural.
                    </p>

                    <p><strong>5. RESPONSABILIDADE DO USUÁRIO</strong></p>
                    <p>
                        5.1. O Usuário concorda em utilizar a Plataforma de forma lícita, respeitando a moral, os bons costumes, as leis e as disposições destes Termos.<br>
                        5.2. Qualquer dano ou prejuízo decorrente do descumprimento destes Termos será de inteira responsabilidade do Usuário infrator, que poderá responder pelas infrações praticadas nas esferas civil, administrativa e/ou penal.
                    </p>

                    <p><strong>6. LIMITAÇÃO DE RESPONSABILIDADE DA PLATAFORMA</strong></p>
                    <p>
                        6.1. A Plataforma envidará esforços para manter um ambiente seguro e amigável, utilizando a rede neural BERTimbau para a identificação de conteúdo ofensivo. Ainda assim, não há garantia de eliminação completa de postagens impróprias ou violações.<br>
                        6.2. A Plataforma não se responsabiliza por postagens ou ações de qualquer Usuário, mas reserva-se o direito de tomar as medidas cabíveis a fim de barrar conteúdo proibido e manter o ambiente harmonioso.
                    </p>

                    <p><strong>7. PRIVACIDADE E PROTEÇÃO DE DADOS</strong></p>
                    <p>
                        7.1. Os dados fornecidos pelo Usuário durante o cadastro e uso da Plataforma serão tratados em conformidade com a legislação aplicável.<br>
                        7.2. Informações sobre tratamento de dados pessoais, políticas de cookies e demais práticas estão descritas na nossa <strong>Política de Privacidade</strong> (documento separado).
                    </p>

                    <p><strong>8. SUSPENSÃO E ENCERRAMENTO DA CONTA</strong></p>
                    <p>
                        8.1. A Plataforma se reserva o direito de suspender ou encerrar a conta de qualquer Usuário que viole estes Termos ou que contribua para a disseminação de conteúdo ofensivo, sem prejuízo de adoção de outras medidas judiciais ou administrativas cabíveis.<br>
                        8.2. O Usuário poderá optar por encerrar voluntariamente sua conta, devendo seguir as orientações fornecidas na Plataforma. Nesse caso, a Plataforma poderá manter registros de postagem de acordo com as obrigações legais e políticas internas.
                    </p>

                    <p><strong>9. ALTERAÇÕES NOS TERMOS DE USO</strong></p>
                    <p>
                        9.1. Estes Termos podem ser atualizados ou modificados periodicamente para garantir o melhor funcionamento da Plataforma.<br>
                        9.2. O Usuário será comunicado sobre alterações substanciais, e o uso continuado da Plataforma após tais mudanças configurará aceite das novas disposições.
                    </p>

                    <p><strong>10. DISPOSIÇÕES GERAIS</strong></p>
                    <p>
                        10.1. A eventual nulidade ou inexequibilidade de qualquer item destes Termos não prejudicará as demais disposições, que permanecerão em pleno vigor.<br>
                        10.2. Estes Termos são regidos pela legislação em vigor [inserir a jurisdição aplicável], e qualquer controvérsia relacionada à interpretação ou cumprimento destas regras será submetida ao foro [inserir o foro de eleição].
                    </p>

                    <p><strong>Última atualização:</strong> [data de publicação dos Termos]</p>
                    <p>
                        Ao continuar o uso da Plataforma, o Usuário declara estar ciente e de acordo com todos os itens destes Termos de Uso.  
                        Caso não concorde, recomenda-se a interrupção imediata de acesso e utilização dos serviços.
                    </p>
                </div>
                <!-- Fim dos Termos de Uso -->

                <!-- Formulário para Concordar ou Não Concordar -->
                <form action="{{ route('concluirCadastro') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-around">
                        <!-- Botão Não Concordo -->
                        <button type="submit" name="concordo" value="nao" class="btn btn-danger">
                            Não Concordo
                        </button>

                        <!-- Botão Concordo (desabilitado inicialmente) -->
                        <button 
                            type="submit" 
                            name="concordo" 
                            value="sim" 
                            class="btn btn-success" 
                            id="agreeBtn" 
                            disabled
                        >
                            Concordo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script para habilitar o botão quando o usuário chegar ao final do texto --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const termsContainer = document.getElementById('termsContainer');
        const agreeBtn = document.getElementById('agreeBtn');

        termsContainer.addEventListener('scroll', function() {
            // Quando o scroll chegar ao final, habilita o botão de Concordo
            if (termsContainer.scrollTop + termsContainer.clientHeight >= termsContainer.scrollHeight) {
                agreeBtn.disabled = false;
            }
        });
    });
</script>
@endsection
