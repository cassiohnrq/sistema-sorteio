// JavaScript Document
		var input = document.querySelector('#inputCpfCnpj');

		input.addEventListener('input', function () {
			mascaraMutuario(this, cpfCnpj);
		});

		input.addEventListener('blur', function () {
			clearTimeout();
		});

		function mascaraMutuario(o, f) {
			v_obj = o
			v_fun = f
			setTimeout(function () {
				v_obj.value = v_fun(v_obj.value)
			}, 1)
		}

		function cpfCnpj(v) {

			//Remove tudo o que não é dígito
			v = v.replace(/\D/g, "")

			if (v.length <= 11) { //CPF

				//Coloca um ponto entre o terceiro e o quarto dígitos
				v = v.replace(/(\d{3})(\d)/, "$1.$2")

				//Coloca um ponto entre o terceiro e o quarto dígitos
				//de novo (para o segundo bloco de nÃºmeros)
				v = v.replace(/(\d{3})(\d)/, "$1.$2")

				//Coloca um hÃ­fen entre o terceiro e o quarto dígitos
				v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")

			} else { //CNPJ

				//Coloca ponto entre o segundo e o terceiro dígitos
				v = v.replace(/^(\d{2})(\d)/, "$1.$2")

				//Coloca ponto entre o quinto e o sexto dígitos
				v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")

				//Coloca uma barra entre o oitavo e o nono dígitos
				v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")

				//Coloca um hÃ­fen depois do bloco de quatro dígitos
				v = v.replace(/(\d{4})(\d)/, "$1-$2")
			}

			return v
		}


		function validateForm() {
			var x = document.forms["cpf"]["cpf"].value;
			if (x == "") {
				alert("Preencha o campo com seu CPF ou CNPJ.");
				return false;
			}
		}
	</script>
	<script>
		function formatar(mascara, documento) {
			var i = documento.value.length;
			var saida = mascara.substring(0, 1);
			var texto = mascara.substring(i)

			if (texto.substring(0, 1) != saida) {
				documento.value += texto.substring(0, 1);
			}

		}
	
	
			$("#cpf").keydown(function () {
			try {
				$("#cpf").unmask();
			} catch (e) { }

			var tamanho = $("#cpf").val().length;

			if (tamanho < 11) {
				$("#cpf").mask("999.999.999-99");
			} else {
				$("#cpf").mask("99.999.999/9999-99");
			}

			// ajustando foco
			var elem = this;
			setTimeout(function () {
				// mudo a posição do seletor
				elem.selectionStart = elem.selectionEnd = 10000;
			}, 0);
			// reaplico o valor para mudar o foco
			var currentValue = $(this).val();
			$(this).val('');
			$(this).val(currentValue);
		});