<div class="sidebar" data-color="orange" data-image="../assets/img/sidebar-0.jpg">
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
                    <a href="../listar/eventos_cadastrados.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Eventos Cadastrados</p>
                    </a>
                </li>
                 <li>
                    <a href="../cadastro/cadastrar_evento.php">
                        <i class="pe-7s-note2"></i>
                        <p>Novo Evento</p>
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
                    <a href="../config/sair.php">
                        <i class="pe-7s-close-circle"></i>
                        <p>Sair</p>
                    </a>
                </li>
            </ul>
                	</div>
                	    </div>