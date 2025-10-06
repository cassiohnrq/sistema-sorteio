        let contador = 10; // Começar a contagem de 10
        let intervalo;
        let confetesInterval; // Controle do intervalo de confetes

        // Função para iniciar a contagem regressiva
        function iniciarContagem() {
            // Resetar o contador e esconder o texto do contador
            contador = 10;
            document.getElementById("contador").style.display = "block"; // Exibe o contador
            document.getElementById("contador").textContent = contador;

            // Habilitar novamente o botão
            const btn = document.getElementById("iniciarBtn");
            btn.disabled = false; // Reabilitar o botão se estiver desabilitado

            // Esconder o modal se ele estiver aberto
            const modal = document.getElementById("myModal");
            modal.style.display = "none";

            // Iniciar a contagem regressiva
            intervalo = setInterval(function() {
                document.getElementById("contador").textContent = contador;
                contador--;

                if (contador < 0) {
                    clearInterval(intervalo);
                    mostrarModal();
                }
            }, 1000); // A cada 1 segundo
        }

        // Função para mostrar o modal
        function mostrarModal() {
            const modal = document.getElementById("myModal");
            modal.style.display = "flex"; // Exibe o modal
            gerarConfetes(); // Começa a gerar confetes quando o modal aparecer
        }

        // Função para fechar o modal
        function fecharModal() {
            const modal = document.getElementById("myModal");
            modal.style.display = "none"; // Fecha o modal
            pararConfetes(); // Para a geração de confetes quando o modal for fechado
        }

        // Função para gerar confetes estourando
        function gerarConfetes() {
            const numConfetes = 100; // Número de confetes

            // Gerar confetes em loop
            confetesInterval = setInterval(function() {
                for (let i = 0; i < numConfetes; i++) {
                    const confete = document.createElement('div');
                    confete.classList.add('confete');
                    confete.style.left = Math.random() * 100 + 'vw'; // Posição aleatória na tela
                    confete.style.top = Math.random() * 100 + 'vh'; // Posição aleatória na tela
                    document.body.appendChild(confete);

                    // Remover o confete depois de animado
                    setTimeout(() => {
                        confete.remove();
                    }, 500); // Remover após a animação
                }
            }, 200); // Gerar confetes a cada 200ms (ajuste conforme necessário)
        }

        // Função para parar os confetes
        function pararConfetes() {
            clearInterval(confetesInterval); // Limpar o intervalo que gera confetes
        }

        // Garantir que o modal não seja exibido ao recarregar a página
        window.onload = function() {
            const modal = document.getElementById("myModal");
            modal.style.display = "none"; // Modal está oculto quando a página carrega
        }

        // Função para reiniciar a contagem com recarga da página
        function reiniciarComRecarregamento() {
            location.reload(); // Recarrega a página
        }// JavaScript Document