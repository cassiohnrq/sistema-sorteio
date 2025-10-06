<div class="sidebar" data-color="orange" data-image="../assets/img/sidebar-0.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->
           <div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text">
                    Sistema Eventos
                </a>
            </div>
               <ul class="nav">
                <li>
                    <a href="#">
                        <i class="pe-7s-user"></i>
                        <p><?php
	echo "Usuário: ". $_SESSION['usuarioNome'];
?></p>
                    </a>
                </li>
                      <li>
                    <a href="../listar/usuarios_cadastrados.php">
                        <i class="pe-7s-users"></i>
                        <p>Usuários Cadastrados</p>
                    </a>
                </li>
                   <li>
                    <a href="../cadastro/cadastrar_usuarios.php">
                        <i class="pe-7s-add-user"></i>
                        <p>Novo Usuário</p>
                    </a>
                </li>
                <li>
                    <a href="../listar/cupons_cadastrados.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Cupons Cadastrados</p>
                    </a>
                </li>
                 <li>
                    <a href="../cadastro/cadastrar_cupons.php">
                        <i class="pe-7s-note2"></i>
                        <p>Novo Cupom</p>
                    </a>
                </li>
				   <li>
                    <a href="../cadastro/novo_sorteio.php">
                        <i class="pe-7s-star"></i>
                        <p>Novo Sorteio</p>
                    </a>
                </li>
                <li>
                    <a href="../importar/importar.php">
                        <i class="pe-7s-server"></i>
                        <p>Importar</p>
                    </a>
                </li>
				                   <li>
                    <a href="../exportar/gerar_planilha.php">
                        <i class="pe-7s-download"></i>
                        <p>Exportar</p>
                    </a>
                </li>
				   <li>
                    <a href="../limpa_tabela/limpar_tabela.php">
                        <i class="pe-7s-delete-user"></i>
                        <p>Limpar Tabela</p>
                    </a>
                </li>
                <li>
                    <a href="../config/sair.php">
                        <i class="pe-7s-close-circle"></i>
                        <p>Sair</p>
                    </a>
                </li>
            </ul>
                	</div>
                	    </div>