<?php
if (isset($_SESSION['MSG'])) {
    switch ($_SESSION['MSG']) {
        case 1: // operacao
            $MSG = 'Operação realizada com êxito.';
            $IMG = 'sucesso';
            break;
        
        case 2: // erro
            $MSG = 'Ops! Algo não saiu como o planejado! Tente novamente ou contate o administrador.';
            $IMG = 'erro';
            break;

        case 3: // contato
            $MSG = 'Erro ao conectar com o servidor de autenticação.';
            $IMG = 'login';
            break;

        case 4: // contato
            $MSG = 'Ouve uma falha ao enviar sua mensagem. Entre em contato com o administrador.';
            $IMG = 'login';
            break;

        case 5: // login
            $MSG = 'Usuário ou senha inválidos, tente novamente';
            $IMG = 'login';
            break;

        case 6: // login
            $MSG = 'Informe seus dados de acesso para ter acesso ao sistema.';
            $IMG = 'login';
            break;

        case 7: // Autenticacao LDAP
            $MSG = 'Erro na autenticação, verifique seu login e senha.';
            $IMG = 'login';
            break;

        case 8: // Conecta AD
            $MSG = 'Erro ao se conectar com o servidor.';
            $IMG = 'login';
            break;

        case 9: // Erro na consulta do usuario no AD
            $MSG = 'Erro na consulta do usuário.';
            $IMG = 'login';
            break;

        case 10: // Autenticacao no banco
            $MSG = 'Usuário não cadastrado no banco.';
            $IMG = 'login';
            break;
        case 11: // Autenticacao no banco
            $MSG = 'Usuário Inativo no sistema, contate o Administrador.';
            $IMG = 'login';
            break;

        case 12: // [Cadastro de Usuário] Usuário Já Existente
            $MSG = 'Usuário Já Cadastrado.';
            $IMG = 'erro';
            break;
        
        case 13: // Material Duplicado
            $MSG = 'Material Já Cadastrada';
            $IMG = 'erro';
            break;
        
        case 14: // Material Duplicado
            $MSG = 'Extensão não permitida';
            $IMG = 'erro';
            break;
        
        case 15: // Material Duplicado
            $MSG = 'Tamanho Acima do Permitido';
            $IMG = 'erro';
            break;
        
        case 16: // [Cadastro de Usuário] Usuário Não Encontrado
            $MSG = 'Usuário Não Encontrado';
            $IMG = 'erro';
            break;
        
        case 17: // [Cadastro de Usuário] Usuário Já Existente
            $MSG = 'Usuário Já Cadastrado';
            $IMG = 'erro';
            break;
        
        case 18: // [Cadastro de Usuário] Sucesso
            $MSG = 'Usuário cadastrado com sucesso';
            $IMG = 'sucesso';
            break;
        
        case 19: // [Edição de Usuário] Perfil em branco
            $MSG = 'Erro ao editar usuário';
            $IMG = 'erro';
            break;
        
        case 20: // [Cadastro de Perfil] Perfil em branco
            $MSG = 'O nome do perfil deve ser preenchido';
            $IMG = 'erro';
            break;
        
        case 21: // [Cadastro de Perfil] Perfil Já Existente
            $MSG = 'Perfil Já Cadastrado';
            $IMG = 'erro';
            break;
        
        case 22:
            $MSG = 'Tamanho do arquivo excedido. Tamanho máximo 10mb';
            $IMG = 'erro';
            break;
        
        case 23:
            $MSG = 'Dimensões da imagem acima da permitida. As dimensões são: 667px x 500px';
            $IMG = 'erro';
            break;
        
        case 24:
            $MSG = 'O histórico não foi criado';
            $IMG = 'erro';
            break;
        
        case 25:
            $MSG = 'O Briefing não foi criado';
            $IMG = 'erro';
            break;
        
        case 26:
            $MSG = 'O serviço não foi criado';
            $IMG = 'erro';
            break;
        
        case 27:
            $MSG = 'A solicitação não foi criada';
            $IMG = 'erro';
            break;
        
        case 28:
            $MSG = 'A imagem não foi salva, tente novamente ou contate um técnico';
            $IMG = 'erro';
            break;
        
        case 29: // [Cadastro de Unidade] Sucesso
            $MSG = 'Unidade cadastrada com sucesso.';
            $IMG = 'sucesso';
            break;
        
        case 30: // [Cadastro de Unidade] Unidade já existente
            $MSG = 'Unidade já cadastrada. Caso queira alterar somente o Estado deve editar o nome da Unidade também.';
            $IMG = 'erro';
            break;
        
        case 31: // [Cadastro de Unidade] Unidade em branco
            $MSG = 'O nome da unidade deve ser preenchido';
            $IMG = 'erro';
            break;
        
        case 32: // [Cadastro de Secretaria] Sucesso
            $MSG = 'Secretaria cadastrada com sucesso.';
            $IMG = 'sucesso';
            break;
        
        case 33: // [Cadastro de Secretaria] Secretaria já existente
            $MSG = 'Secretaria já cadastrada.';
            $IMG = 'erro';
            break;
        
        case 34: // [Cadastro de Secretaria] Secretaria em branco
            $MSG = 'O nome da secretaria deve ser preenchido';
            $IMG = 'erro';
            break;
        
    }

    if (isset($IMG)) {
        if ($IMG == 'erro') {
            ?>

            <div id="pulsate-danger" class="alert alert-block alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert"></button>
                <h4 class="alert-heading">Erro!</h4>
                <p>
                    <?php echo $MSG ?>
                </p>
            </div>
            <?php
        } else if ($IMG == 'sucesso') {
            ?>
            <div id="pulsate-success" class="alert alert-block alert-success fade in">
                <button type="button" class="close" data-dismiss="alert"></button>
                <h4 class="alert-heading">Sucesso!</h4>
                <p>
                    <?php echo $MSG ?>
                </p>
            </div>
            <?php
        } else if ($IMG == 'login') {
            echo '
        <div id="pulsate-danger" class="alert alert-danger fade in">
            <button class="close" data-close="alert"></button>'
            . @$MSG .
        '</div>';
        }
        unset($_SESSION['MSG']);
    }
}
?>


